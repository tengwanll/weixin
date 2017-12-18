<?php
/**
 * Created by PhpStorm.
 * User: 31726
 * Date: 2017/12/18
 * Time: 10:24
 */

namespace Mirror\ApiBundle\Model;

use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("box_model",parent="base_model")
 * Class BoxModel
 * @package Mirror\ApiBundle\Model
 */
class BoxModel extends BaseModel
{
    private $repositoryName = 'MirrorApiBundle:Box';

    public function getRepositoryName() {
        return $this->repositoryName;
    }
}