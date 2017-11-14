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
 * @Route("/pay")
 * Class IndexController
 * @package Mirror\WebBundle\Controller
 */
class PayController extends Controller
{
    /**
     * @Route("/{orderId}",requirements={"orderId":"\d+"})
     * @Template()
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request,$orderId){
        $code=$request->get('code','');
        $openId = $this->getRequest ()->getSession ()->get ( 'openId', '' );
        if (!$openId) {
            $result = WeixinHelper::getWeixinId ( $code );
            $openId=Helper::getc($result,'openid','');
            $this->getRequest ()->getSession ()->set ( 'openId', $openId );
        }
        $status=$this->get('user_service')->checkLogin($openId);
        if($status){
            return $this->render('MirrorWebBundle:Login:index.html.twig',array('openId'=>$openId));
        }
        return array('openId'=>$openId,'orderId'=>$orderId);
    }
}