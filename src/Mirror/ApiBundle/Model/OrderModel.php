<?php
/**
 * Created by PhpStorm.
 * User: 31726
 * Date: 2017/10/31
 * Time: 17:12
 */

namespace Mirror\ApiBundle\Model;

use JMS\DiExtraBundle\Annotation as DI;

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
}