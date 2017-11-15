<?php
/**
 * Created by PhpStorm.
 * User: 31726
 * Date: 2017/10/31
 * Time: 16:12
 */

namespace Mirror\ApiBundle\Controller;


use Mirror\ApiBundle\Common\Code;
use Mirror\ApiBundle\ViewModel\ReturnResult;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/user")
 * Class UserController
 * @package Mirror\ApiBundle\Controller
 */
class UserController extends BaseController
{
    /**
     * 登录
     * @Route("/login")
     * @Method("POST")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function login(Request $request){
        $json=$this->getJson($request);
        $telephone=$json->get('telephone','');
        $code=$json->get('code','');
        $openId=$this->sessionGet($request,'openId','');
        // 验证手机验证码
        if($this->get('telephone_code_service')->validateCode($telephone,$code)){
            $this->get('telephone_code_service')->completeValid($telephone, $code);
        }else{
            return $this->buildResponse(new ReturnResult(Code::$code_error));
        }
        $rr=$this->get('user_service')->login($telephone,$openId);
        return $this->buildResponse($rr);
    }

    /**
     * 退出登录
     * @Route("/logout")
     * @Method("POST")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function logout(Request $request){
        $openId=$this->sessionGet($request,'openId','');
        $rr=$this->get('user_service')->logout($openId);
        return $this->buildResponse($rr);
    }

    /**
     * 获取订单列表
     * @Route("/order")
     * @Method("GET")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getOrderList(Request $request){
        $openId=$this->sessionGet($request,'openId','');
        $openId='ob0nEw5dVJjsD6Z96o_BEwgSWjMM';
        $orderBy=$request->get('orderBy',null);
        $rr=$this->get('order_service')->getUserOrderList($openId,$orderBy);
        return $this->buildResponse($rr);
    }
}