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
        $rr=$this->get('order_service')->create($order,$openId);
        return $this->buildResponse($rr);
    }

    /**
     * 获取订单详情
     * @Route("/{orderId}",requirements={"orderId":"\d+"})
     * @Method("GET")
     * @param $orderId
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getInfo($orderId){
        $rr=$this->get('order_service')->getInfo($orderId);
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
        $openId=$this->sessionGet($request,'openId','');
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

    /**
     * 修改订单地址
     * @Route()
     * @Method("PUT")
     * @param Request $request
     * @return Response
     */
    public function update(Request $request){
        $json = $this->getJson($request);
        $address=$json->get('address','');
        $userName=$json->get('userName','');
        $userAge=$json->get('userAge','');
        $isMarried=$json->get('isMarried','');
        $orderId=$json->get('orderId','');
        $rr=$this->get('order_service')->update($address,$orderId,$userName,$userAge,$isMarried);
        return $this->buildResponse($rr);
    }
}