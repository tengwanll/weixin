<?php
/**
 * Created by PhpStorm.
 * User: 31726
 * Date: 2017/11/1
 * Time: 16:56
 */

namespace Mirror\ApiBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/order")
 * Class OrderController
 * @package Mirror\ApiBundle\Controller
 */
class OrderController extends BaseController
{
    /**
     * 创建订单
     * @Route("")
     * @Method("POST")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function create(Request $request){
        $order=$goods=$this->serializerByJson($request,'Orders');
        $openId=$this->sessionGet($request,'openId','');
        $openId='ob0nEw5dVJjsD6Z96o_BEwgSWjMM';
        $rr=$this->get('order_service')->create($order,$openId);
        return $this->buildResponse($rr);
    }

    /**
     * 调起支付
     * @Route("/pay")
     * @Method("POST")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function pay(Request $request){
        $json=$this->getJson($request);
        $orderId=$json->get('orderId',0);
        $openId=$this>$this->sessionGet($request,'openId','');
        $openId='ob0nEw5dVJjsD6Z96o_BEwgSWjMM';
        $rr=$this->get('order_service')->pay($orderId,$openId);
        return $this->buildResponse($rr);
    }

    /**
     * 获取商品信息
     * @Route("/goods")
     * @Method("GET")
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getGoods(){
        $rr=$this->get('order_service')->getGoods();
        return $this->buildResponse($rr);
    }

    /**
     * 支付回调
     * @Route("/notify")
     * @param Request $request
     * @return Response
     */
    public function notify(Request $request){
        $xml = $request->getContent();
        $rr=$this->get('order_service')->notify($xml);
        return new Response($rr);
    }
}