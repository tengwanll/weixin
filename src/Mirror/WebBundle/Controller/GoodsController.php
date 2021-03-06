<?php
/**
 * Created by PhpStorm.
 * User: 31726
 * Date: 2017/11/3
 * Time: 10:31
 */

namespace Mirror\WebBundle\Controller;


use Mirror\ApiBundle\Util\Helper;
use Mirror\ApiBundle\Util\WeixinHelper;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/goods")
 * Class IndexController
 * @package Mirror\WebBundle\Controller
 */
class GoodsController extends Controller
{
    /**
     * @Route("/{id}",requirements={"id":"\d+"})
     * @Template()
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request,$id){
        $code=$request->get('code','');
        $openId = $request->getSession ()->get ( 'openId', '' );
        if (!$openId) {
            $result = WeixinHelper::getWeixinId ( $code );
            $openId=Helper::getc($result,'openid','');
            $request->getSession ()->set ( 'openId', $openId );
        }
        if($id==1){
            $referer='/web/index';
        }else{
            $referer='/web/index/face';
        }
        $status=$this->get('user_service')->checkLogin($openId);
        if(!$status){
            return $this->render('MirrorWebBundle:Login:index.html.twig',array('openId'=>$openId,'referer'=>$referer));
        }
        return array('openId'=>$openId,'version'=>mt_rand(1000,9999),'id'=>$id);
    }
}