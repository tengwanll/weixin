<?php
/**
 * Created by PhpStorm.
 * User: 31726
 * Date: 2017/10/31
 * Time: 17:09
 */

namespace Mirror\ApiBundle\Service;


use JMS\DiExtraBundle\Annotation as DI;
use Mirror\ApiBundle\Common\Code;
use Mirror\ApiBundle\Model\TelephoneCodeModel;
use Mirror\ApiBundle\Model\UserModel;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use Mirror\ApiBundle\ViewModel\ReturnResult;

/**
 * @DI\Service("user_service")
 * Class UserService
 * @package Mirror\ApiBundle\Service
 */
class UserService
{
    private $userModel;
    private $telephoneCodeModel;

    /**
     * @InjectParams({
     *     "userModel"=@Inject("user_model"),
     *     "telephoneCodeModel"=@Inject("telephone_model")
     * })
     * UserService constructor.
     * @param UserModel $userModel
     * @param TelephoneCodeModel $telephoneCodeModel
     */
    public function __construct(UserModel $userModel,TelephoneCodeModel $telephoneCodeModel)
    {
        $this->userModel=$userModel;
        $this->telephoneCodeModel=$telephoneCodeModel;
    }

    public function login($telephone,$openId){
        $rr=new ReturnResult();
        if(!$openId){
            $rr->errno=Code::$openId_null;
            return $rr;
        }
        $user=$this->userModel->getOneByProperty('openId',$openId);
        /**@var $user \Mirror\ApiBundle\Entity\User*/
        if($user){
            $user->setTelephone($telephone);
            $this->userModel->flush($user);
        }else{
            $this->userModel->add($telephone,$openId);
        }
        return $rr;
    }

    public function checkLogin($openId){
        $user=$this->userModel->getOneByProperty('openId',$openId);
        /**@var $user \Mirror\ApiBundle\Entity\User*/
        if($user&&$user->getTelephone()){
            $status=1;
        }else{
            $status=0;
        }
        return $status;
    }

    public function logout($openId){
        $rr=new ReturnResult();
        $user=$this->userModel->getOneByProperty('openId',$openId);
        /**@var $user \Mirror\ApiBundle\Entity\User*/
        if($user){
            $user->setTelephone('');
            $this->userModel->flush($user);
        }
        return $rr;
    }
}