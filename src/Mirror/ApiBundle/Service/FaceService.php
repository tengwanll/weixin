<?php
/**
 * Created by PhpStorm.
 * User: 31726
 * Date: 2017/12/18
 * Time: 10:23
 */

namespace Mirror\ApiBundle\Service;

use JMS\DiExtraBundle\Annotation as DI;
use Mirror\ApiBundle\Common\Code;
use Mirror\ApiBundle\Common\Constant;
use Mirror\ApiBundle\Entity\BoxInfo;
use Mirror\ApiBundle\Model\BoxGeneModel;
use Mirror\ApiBundle\Model\BoxInfoModel;
use Mirror\ApiBundle\Model\BoxModel;
use Mirror\ApiBundle\ViewModel\ReturnResult;
use JMS\DiExtraBundle\Annotation\Inject;

/**
 * @DI\Service("face_service")
 * Class FaceService
 * @package Mirror\ApiBundle\Service
 */
class FaceService
{
    private $boxModel;
    private $boxInfoModel;
    private $boxGeneModel;

    /**
     * @DI\InjectParams()
     * FaceService constructor.
     * @param BoxModel $boxModel
     * @param BoxGeneModel $boxGeneModel
     * @param BoxInfoModel $boxInfoModel
     */
    public function __construct(BoxModel $boxModel,BoxGeneModel $boxGeneModel,BoxInfoModel $boxInfoModel)
    {
        $this->boxModel=$boxModel;
        $this->boxGeneModel=$boxGeneModel;
        $this->boxInfoModel=$boxInfoModel;
    }

    public function getInfo($boxId){
        $rr=new ReturnResult();
        $boxInfo=$this->boxInfoModel->getOneByProperty('boxId',$boxId);
        $arr=array('status'=>false);
        if($boxInfo){
            /**@var $boxInfo \Mirror\ApiBundle\Entity\BoxInfo*/
            $arr=array(
                'name'=>$boxInfo->getName(),
                'age'=>$boxInfo->getAge(),
                'gender'=>$boxInfo->getGender(),
                'email'=>$boxInfo->getEmail(),
                'telephone'=>$boxInfo->getTelephone(),
                'ability'=>json_decode($boxInfo->getAbility()),
                'status'=>true
            );
        }
        $rr->result=$arr;
        return $rr;
    }

    /**
     * @param BoxInfo $boxInfoE
     * @return ReturnResult
     */
    public function update(BoxInfo $boxInfoE){
        $rr=new ReturnResult();
        $boxId=$boxInfoE->getBoxId();
        $box=$this->boxModel->getOneByProperty('uniqueId',$boxId);
        /**@var $box \Mirror\ApiBundle\Entity\Box*/
        if(!$box){
            $rr->errno=Code::$box_not_exist;
            return $rr;
        }
        $boxInfo=$this->boxInfoModel->getOneByProperty('boxId',$boxId);
        if($boxInfo){
            /**@var $boxInfo \Mirror\ApiBundle\Entity\BoxInfo*/
            $this->boxInfoModel->update($boxInfoE,$boxInfo);
        }else{
            $res=$this->boxInfoModel->add($boxInfoE);
            if($res){
                $box->setStatus(Constant::$box_status_filled);
                $this->boxModel->save($box);
            }
        }
        return $rr;
    }
}