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
//        $boxInfo=$this->boxInfoModel->getOneByProperty('boxId',$boxId);
        $boxInfo=$this->boxInfoModel->getOneByProperty('box_id',$boxId);
        $arr=array('status'=>false);
        if($boxInfo){
            $arr=array(
                'name'=>$boxInfo['name'],
                'age'=>$boxInfo['age'],
                'gender'=>$boxInfo['gender'],
                'email'=>$boxInfo['email'],
                'telephone'=>$boxInfo['telephone'],
                'ability'=>json_decode($boxInfo['ability']),
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
        $box=$this->boxModel->getOneByProperty('unique_id',$boxId);
        /**@var $box \Mirror\ApiBundle\Entity\Box*/
        if(!$box){
            $rr->errno=Code::$box_not_exist;
            return $rr;
        }
        $boxInfo=$this->boxInfoModel->getOneByProperty('box_id',$boxId);
        if($boxInfo){
            $update=array(
                'name'=>$boxInfoE->getName(),
                'gender'=>$boxInfoE->getGender(),
                'age'=>$boxInfoE->getAge(),
                'email'=>$boxInfoE->getEmail(),
                'telephone'=>(int)$boxInfoE->getTelephone(),
                'ability'=>$boxInfoE->getAbility()
            );
            /**@var $boxInfo \Mirror\ApiBundle\Entity\BoxInfo*/
            $this->boxInfoModel->update($update,array('box_id'=>$boxId));
        }else{
            $date=date('Y-m-d H:i:s');
            $add=array(
                'box_id'=>$boxId,
                'name'=>$boxInfoE->getName(),
                'gender'=>$boxInfoE->getGender(),
                'age'=>$boxInfoE->getAge(),
                'email'=>$boxInfoE->getEmail(),
                'telephone'=>(int)$boxInfoE->getTelephone(),
                'ability'=>$boxInfoE->getAbility(),
                'status'=>Constant::$status_normal,
                'create_time'=>$date,
                'update_time'=>$date
            );
            $res=$this->boxInfoModel->save($add);
        }
        return $rr;
    }
}