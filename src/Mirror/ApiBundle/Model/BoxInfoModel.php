<?php
/**
 * Created by PhpStorm.
 * User: 31726
 * Date: 2017/12/18
 * Time: 10:24
 */

namespace Mirror\ApiBundle\Model;

use JMS\DiExtraBundle\Annotation as DI;
use Mirror\ApiBundle\Common\Constant;
use Mirror\ApiBundle\Entity\BoxInfo;

/**
 * @DI\Service("box_info_model",parent="base_model")
 * Class BoxModel
 * @package Mirror\ApiBundle\Model
 */
class BoxInfoModel extends BaseModel
{
    private $repositoryName = 'MirrorApiBundle:BoxInfo';

    public function getRepositoryName() {
        return $this->repositoryName;
    }

    /**
     * @param BoxInfo $boxInfo
     * @return mixed
     */
    public function add(BoxInfo $boxInfo){
        $date=new \DateTime();
        $info=new BoxInfo();
        $info->setName($boxInfo->getName());
        $info->setAge($boxInfo->getAge());
        $info->setGender($boxInfo->getGender());
        $info->setBoxId($boxInfo->getBoxId());
        $info->setEmail($boxInfo->getEmail());
        $info->setTelephone($boxInfo->getTelephone());
        $info->setIsElasticity($boxInfo->getIsElasticity()?1:0);
        $info->setIsLock($boxInfo->getIsLock()?1:0);
        $info->setIsOxidation($boxInfo->getIsOxidation()?1:0);
        $info->setIsSensitive($boxInfo->getIsSensitive()?1:0);
        $info->setIsStain($boxInfo->getIsStain()?1:0);
        $info->setIsUltraviolet($boxInfo->getIsUltraviolet()?1:0);
        $info->setAbility($boxInfo->getAbility());
        $info->setStatus(Constant::$status_normal);
        $info->setCreateTime($date);
        $info->setUpdateTime($date);
        return $this->save($info);
    }

    /**
     * @param BoxInfo $boxInfo  修改的参数保存对象
     * @param BoxInfo $info     被修改的对象
     * @return mixed
     */
    public function update(BoxInfo $boxInfo,BoxInfo $info){
        $info->setName($boxInfo->getName());
        $info->setAge($boxInfo->getAge());
        $info->setGender($boxInfo->getGender());
        $info->setEmail($boxInfo->getEmail());
        $info->setTelephone($boxInfo->getTelephone());
        $info->setIsElasticity($boxInfo->getIsElasticity());
        $info->setIsLock($boxInfo->getIsLock());
        $info->setIsOxidation($boxInfo->getIsOxidation());
        $info->setIsSensitive($boxInfo->getIsSensitive());
        $info->setIsStain($boxInfo->getIsStain());
        $info->setIsUltraviolet($boxInfo->getIsUltraviolet());
        $info->setAbility($boxInfo->getAbility());
        return $this->save($info);
    }
}