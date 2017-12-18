<?php
/**
 * Created by PhpStorm.
 * User: 31726
 * Date: 2017/12/18
 * Time: 10:16
 */

namespace Mirror\ApiBundle\Controller;


use Mirror\ApiBundle\Entity\BoxInfo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/face")
 * Class FaceController
 * @package Mirror\ApiBundle\Controller
 */
class FaceController extends BaseController
{
    /**
     * @Route("/{boxId}",requirements={"boxId":"\d+"})
     * @Method("GET")
     * @param $boxId
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getInfo($boxId){
        $rr=$this->get('face_service')->getInfo($boxId);
        return $this->buildResponse($rr);
    }

    /**
     * @Route("")
     * @Method("POST")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function update(Request $request){
        $json=$this->getJson($request);
        $boxInfo=new BoxInfo();
        $boxInfo->setAbility(json_encode($json->get('ability',[])));
        $boxInfo->setName($json->get('name',''));
        $boxInfo->setAge($json->get('age',0));
        $boxInfo->setGender($json->get('gender',0));
        $boxInfo->setBoxId($json->get('boxId',''));
        $boxInfo->setEmail($json->get('email',''));
        $boxInfo->setTelephone($json->get('telephone',''));
        $rr=$this->get('face_service')->update($boxInfo);
        return $this->buildResponse($rr);
    }

}