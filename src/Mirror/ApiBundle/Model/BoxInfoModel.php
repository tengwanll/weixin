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
 * @DI\Service("box_info_model",parent="dbal_base_model")
 * Class BoxModel
 * @package Mirror\ApiBundle\Model
 */
class BoxInfoModel extends DbalBaseModel
{
    private $tableName = 'box_info';

    public function getTableName() {
        return $this->tableName;
    }
}