<?php
/**
 * Created by PhpStorm.
 * User: 31726
 * Date: 2017/12/16
 * Time: 14:33
 */

namespace Mirror\WebBundle\Controller;


use Mirror\ApiBundle\Util\Helper;
use Mirror\ApiBundle\Util\WeixinHelper;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/face")
 * Class FaceController
 * @package Mirror\WebBundle\Controller
 */
class FaceController extends Controller
{
    /**
     * @Template()
     * @Route("/{boxId}")
     * @return array
     */
    public function infoAction($boxId,Request $request){
        $boxId=base64_decode($boxId);
        $code=$request->get('code','');
        $openId='';
        if($code){
            $result = WeixinHelper::getWeixinId ( $code );
            $openId=Helper::getc($result,'openid','');
//            $token=WeixinHelper::getToken();
//            $userInfo=WeixinHelper::getUserInfo($openId,$token);
//            if(!$userInfo['subscribe']){
//                return $this->render('MirrorWebBundle:Face:attention.html.twig',array());
//            }
        }
        return array('boxId'=>$boxId,'openId'=>$openId,'version'=>mt_rand(1000,9999));
    }

    /**
     * @Template()
     * @Route("/index")
     * @param Request $request
     * @return array
     */
    public function indexAction(Request $request){
        $code=$request->get('code','');
        $openId = $request->getSession ()->get ( 'openId', '' );
        if (!$openId) {
            $result = WeixinHelper::getWeixinId ( $code );
            $openId=Helper::getc($result,'openid','');
            $request->getSession ()->set ( 'openId', $openId );
        }
        $status=$this->get('user_service')->checkLogin($openId);
        return array('openId'=>$openId,'status'=>$status,'version'=>mt_rand(1000,9999));
    }
}