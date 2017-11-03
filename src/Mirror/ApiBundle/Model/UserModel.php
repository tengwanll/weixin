<?php
/**
 * Created by PhpStorm.
 * User: 31726
 * Date: 2017/10/31
 * Time: 17:10
 */

namespace Mirror\ApiBundle\Model;

use JMS\DiExtraBundle\Annotation as DI;
use Mirror\ApiBundle\Common\Constant;
use Mirror\ApiBundle\Entity\User;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @DI\Service("user_model",parent="base_model")
 * Class UserModel
 * @package Mirror\ApiBundle\Model
 */
class UserModel extends BaseModel
{
    private $repositoryName = 'MirrorApiBundle:User';

    public function getRepositoryName() {
        return $this->repositoryName;
    }

    public function add($telephone,$openId){
        $user=new User();
        $date=new \DateTime();
        $user->setTelephone($telephone);
        $user->setOpenid($openId);
        $user->setStatus(Constant::$status_normal);
        $user->setCreateTime($date);
        $user->setUpdateTime($date);
        return $this->save($user);
    }
}