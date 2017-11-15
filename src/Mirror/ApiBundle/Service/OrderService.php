<?php
/**
 * Created by PhpStorm.
 * User: 31726
 * Date: 2017/11/1
 * Time: 17:10
 */

namespace Mirror\ApiBundle\Service;


use JMS\DiExtraBundle\Annotation as DI;
use Mirror\ApiBundle\Common\Code;
use Mirror\ApiBundle\Common\Constant;
use Mirror\ApiBundle\Entity\Orders;
use Mirror\ApiBundle\Model\GoodsModel;
use Mirror\ApiBundle\Model\OrderModel;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use Mirror\ApiBundle\Model\UserModel;
use Mirror\ApiBundle\Util\WxPay\JsApiPay;
use Mirror\ApiBundle\Util\WxPay\WxPayApi;
use Mirror\ApiBundle\Util\WxPay\WxPayOrderQuery;
use Mirror\ApiBundle\Util\WxPay\WxPayResults;
use Mirror\ApiBundle\Util\WxPay\WxPayUnifiedOrder;
use Mirror\ApiBundle\ViewModel\ReturnResult;
use Monolog\Logger;

/**
 * @DI\Service("order_service")
 * Class OrderService
 * @package Mirror\ApiBundle\Service
 */
class OrderService
{
    private $orderModel;
    private $goodsModel;
    private $userModel;
    private $logger;
    private $fileService;
    /**
     * @InjectParams({
     *     "orderModel"=@Inject("order_model"),
     *     "goodsModel"=@Inject("goods_model"),
     *     "userModel"=@Inject("user_model"),
     *     "logger"=@Inject("logger"),
     *     "fileService"=@Inject("file_service")
     * })
     * OrderService constructor.
     * @param OrderModel $orderModel
     * @param GoodsModel $goodsModel
     */
    public function __construct(OrderModel $orderModel,GoodsModel $goodsModel,UserModel $userModel,Logger $logger,FileService $fileService)
    {
        $this->goodsModel=$goodsModel;
        $this->orderModel=$orderModel;
        $this->userModel=$userModel;
        $this->logger=$logger;
        $this->fileService=$fileService;
    }

    /**
     * @param Orders $order
     * @param $openId
     * @return int|ReturnResult
     */
    public function create(Orders $order,$openId){
        $rr=new ReturnResult();
        if(!$openId){
            $rr->errno=Code::$openId_null;
            return $rr;
        }
        $user=$this->userModel->getOneByProperty('openId',$openId);
        /**@var $user \Mirror\ApiBundle\Entity\User*/
        if(!$user){
            $rr->errno=Code::$user_not_exist;
            return $rr;
        }
        $goods=$this->goodsModel->getById(Constant::$goods_id);
        /**@var $goods \Mirror\ApiBundle\Entity\Goods*/
        if(!$goods){
            $rr->errno=Code::$goods_not_exist;
            return $rr;
        }
        $order=$this->orderModel->add('',$user,$goods,$order->getRemark(),$order->getNumber(),$order->getPrice());
        $rr->result=array('orderId'=>$order->getId());
        return $rr;
    }

    /**
     * @param $orderId
     * @param $openId
     * @return ReturnResult
     * @throws \Mirror\ApiBundle\Util\WxPay\WxPayException
     */
    public function pay($orderId,$openId){
        $rr=new ReturnResult();
        $order=$this->orderModel->getById($orderId);
        /**@var $order \Mirror\ApiBundle\Entity\Orders*/
        if(!$order)
        {
            $rr->errno=Code::$order_not_exist;
            return $rr;
        }
        $returnOrderNumber=$order->getOrderNo();
        $status=$order->getStatus();
        if($status==Constant::$order_status_success)
        {//订单已支付
            $rr->errno=Code::$order_had_paid;
            return $rr;
        }

        $tools=new JsApiPay();
        $input=new WxPayUnifiedOrder();
        $title=$order->getName();
        $input->SetBody($title);
        $input->SetAttach($title);
        $price=$order->getPrice();
        $price=$price*100;
        //todo delete next line
        // $price=1;
        $input->SetOut_trade_no ( $returnOrderNumber );
        $input->SetTotal_fee ( $price );
        $input->SetTime_start ( date ( "YmdHis" ) . "" );
        $input->SetTime_expire ( date ( "YmdHis", time () + 600 ) . '' );
        $input->SetGoods_tag($title);
        $input->SetNotify_url ( Constant::$WX_NOTIFY_PATH );
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);
        $order=WxPayApi::unifiedOrder($input);
        $jsApiParameters = $tools->GetJsApiParameters ( $order );
        $rr->result=array(
            'jsApiParameters'=>$jsApiParameters,
            'title'=>$title,
            'price'=>$price/100,
            'orderNumber'=>$returnOrderNumber
        );
        return $rr;
    }
    
    public function getGoods(){
        $rr=new ReturnResult();
        $goods=$this->goodsModel->getById(Constant::$goods_id);
        /**@var $goods \Mirror\ApiBundle\Entity\Goods*/
        $logo=$this->fileService->getFullUrlById($goods->getLogo());
        $banner=$this->fileService->getFullUrlById($goods->getBanner());
        $arr=array(
            'name'=>$goods->getName(),
            'price'=>$goods->getPrice(),
            'oldPrice'=>$goods->getOldPrice(),
            'desc'=>$goods->getDesc(),
            'logo'=>$logo,
            'banner'=>$banner
        );
        $rr->result=$arr;
        return $rr;
    }

    public function notify($xml){
        try {
            $params = WxPayResults::Init($xml);
        } catch (\Exception $e){
            $this->logger->info('微信回调报错--'.$e->getMessage().'--'.date('Y-m-d H:i:s'));
            return $msg = $e->getMessage();
        }
        $transaction_id=$params['transaction_id'];
        $orderNo=$params['out_trade_no'];
        $input = new WxPayOrderQuery();
        $input->SetTransaction_id($transaction_id);
        $result = WxPayApi::orderQuery($input);
        if(array_key_exists("return_code", $result)
            && array_key_exists("result_code", $result)
            && $result["return_code"] == "SUCCESS"
            && $result["result_code"] == "SUCCESS")
        {
            $order=$this->orderModel->getOneByProperty('orderNo',$orderNo);
            /**@var $order \Mirror\ApiBundle\Entity\Orders*/
            //检查是否已经处理过
            if($order->getStatus()==Constant::$order_status_wait){
                $date=time();
                $order->setTradeNo($transaction_id);
                $order->setPayTime($date);
                $order->setStatus(Constant::$order_status_success);
                if($this->orderModel->save($order)){
                    $data=array(
                        'return_code'=>$params['result_code'],
                        'return_msg'=>isset($params['return_msg'])?$params['return_msg']:'OK'
                    );
                    $this->logger->info('微信回调成功--'.date('Y-m-d H:i:s'));
                    return  $this->toxml($data);
                }else{
                    $this->logger->info('微信回调报错--订单状态修改失败--'.date('Y-m-d H:i:s'));
                }
            }
        }else{
            $this->logger->info('微信回调报错--微信支付回调未成功--'.date('Y-m-d H:i:s'));
        }
    }

    public static function toxml(array $value){
        $xml = "<xml>";
        foreach ($value as $key => $val) {
            if (is_numeric($val)) {
                $xml .= "<".$key.">".$val."</".$key.">";
            } else {
                $xml .= "<".$key."><![CDATA[".$val."]]></".$key.">";
            }
        }
        $xml .= "</xml>";
        return $xml;
    }

    public function getUserOrderList($openId,$orderBy){
        $rr=new ReturnResult();
        if(!$openId){
            $rr->errno=Code::$openId_null;
            return $rr;
        }
        $user=$this->userModel->getOneByProperty('openId',$openId);
        if(!$user){
            $rr->errno=Code::$user_not_exist;
            return $rr;
        }
        $list=$this->orderModel->getByCriteria(array('status'=>Constant::$order_status_success,'userId'=>$user->getId()),$orderBy);
        $arr=array();
        foreach ($list as $order){
            /**@var $order \Mirror\ApiBundle\Entity\Orders*/
            $report=$this->fileService->getFullUrlById($order->getReport());
            $goods=$this->goodsModel->getById($order->getGoodsId());
            $logo=$this->fileService->getFullUrlById($goods->getLogo());
            $arr[]=array(
                'orderId'=>$order->getId(),
                'name'=>$order->getName(),
                'orderNo'=>$order->getOrderNo(),
                'price'=>$order->getPrice(),
                'address'=>$order->getAddress(),
                'payTime'=>$order->getPayTime(),
                'remark'=>$order->getRemark(),
                'number'=>$order->getNumber(),
                'report'=>$report,
                'logo'=>$logo
            );
        }
        $rr->result=array(
            'list'=>$arr
        );
        return $rr;
    }

    public function getInfo($orderId){
        $rr=new ReturnResult();
        $order=$this->orderModel->getById($orderId);
        /**@var $order \Mirror\ApiBundle\Entity\Orders*/
        if(!$order){
            $rr->errno=Code::$order_not_exist;
            return $rr;
        }
        $arr=array(
            'orderNo'=>$order->getOrderNo(),
            'number'=>$order->getNumber(),
            'price'=>$order->getPrice(),
            'name'=>$order->getName(),
        );
        $rr->result=$arr;
        return $rr;
    }

    public function update($address,$orderId){
        $rr=new ReturnResult();
        $order=$this->orderModel->getById($orderId);
        /**@var $order \Mirror\ApiBundle\Entity\Orders*/
        if(!$order){
            $rr->errno=Code::$order_not_exist;
            return $rr;
        }
        $order->setAddress($address);
        $this->orderModel->save($order);
        return $rr;
    }
}