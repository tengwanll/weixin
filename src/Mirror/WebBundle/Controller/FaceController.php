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
            $token=WeixinHelper::refreshToken();
            $userInfo=WeixinHelper::getUserInfo($openId,$token);
            var_dump($userInfo);
        }
        return array('boxId'=>$boxId,'openId'=>$openId);
    }
}