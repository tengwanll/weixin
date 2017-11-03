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
 * @DI\Service("goods_model",parent="base_model")
 * Class GoodsModel
 * @package Mirror\ApiBundle\Model
 */
class GoodsModel extends BaseModel
{
    private $repositoryName = 'MirrorApiBundle:Goods';

    public function getRepositoryName() {
        return $this->repositoryName;
    }
}