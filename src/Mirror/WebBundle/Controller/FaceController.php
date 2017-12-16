<?php
/**
 * Created by PhpStorm.
 * User: 31726
 * Date: 2017/12/16
 * Time: 14:33
 */

namespace Mirror\WebBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


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
    public function infoAction($boxId){
        return array('boxId'=>$boxId);
    }
}