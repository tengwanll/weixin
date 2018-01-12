<?php
/**
 * Created by PhpStorm.
 * User: 31726
 * Date: 2017/12/18
 * Time: 10:52
 */

namespace Mirror\ApiBundle\Model;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("box_gene_model",parent="dbal_base_model")
 * Class BoxModel
 * @package Mirror\ApiBundle\Model
 */
class BoxGeneModel extends DbalBaseModel
{
    private $tableName = 'weixin.box_gene';

    public function getTableName() {
        return $this->tableName;
    }
}