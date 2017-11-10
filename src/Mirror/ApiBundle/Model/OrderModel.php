<?php
/**
 * Created by PhpStorm.
 * User: 31726
 * Date: 2017/10/31
 * Time: 17:12
 */

namespace Mirror\ApiBundle\Model;

use JMS\DiExtraBundle\Annotation as DI;
use Mirror\ApiBundle\Common\Constant;
use Mirror\ApiBundle\Entity\Goods;
use Mirror\ApiBundle\Entity\Order;
use Mirror\ApiBundle\Entity\User;
use Mirror\ApiBundle\Util\OrderHelper;

/**
 * @DI\Service("order_model",parent="base_model")
 * Class OrderModel
 * @package Mirror\ApiBundle\Model
 */
class OrderModel extends BaseModel
{
    private $repositoryName = 'MirrorApiBundle:Order';

    public function getRepositoryName() {
        return $this->repositoryName;
    }

    /**
     * @param $address
     * @param User $user
     * @param Goods $goods
     * @param $remark
     * @return mixed
     */
    public function add($address,User $user,Goods $goods,$remark){
        $order=new Order();
        $orderNo=OrderHelper::generateTradeNo();
        $date=new \DateTime();
        $order->setUserId($user->getId());
        $order->setGoodsId(Constant::$goods_id);
        $order->setStatus(Constant::$order_status_wait);
        $order->setUpdateTime($date);
        $order->setCreateTime($date);
        $order->setOrderNo($orderNo);
        $order->setName($goods->getName());
        $order->setPrice($goods->getPrice());
        $order->setAddress($address);
        $order->setRemark($remark);
        return $this->save($order);
    }
}