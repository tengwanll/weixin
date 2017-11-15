<?php

namespace Mirror\WebBundle\Controller;

use Mirror\ApiBundle\Util\Helper;
use Mirror\ApiBundle\Util\WeixinHelper;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/login")
 * Class LoginController
 * @package Mirror\WebBundle\Controller
 */
class LoginController extends Controller
{
    /**
     * @Route("")
     * @Template
     * @param Request $request
     * @return array
     */
    public function indexAction(Request $request)
    {
        $code=$request->get('code','');
        $openId = $this->getRequest ()->getSession ()->get ( 'openId', '' );
        if (!$openId&&$code) {
            $result = WeixinHelper::getWeixinId ( $code );
            $openId=Helper::getc($result,'openid','');
            $request->getSession ()->set ( 'openId', $openId );
        }
        $status=$this->get('user_service')->checkLogin($openId);
        if($status){
            return $this->render('MirrorWebBundle:Index:index.html.twig',array('openId'=>$openId));
        }
        return array('openId'=>$openId);
    }
}
