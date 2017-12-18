<?php

namespace Mirror\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BoxGene
 *
 * @ORM\Table(name="box_gene", uniqueConstraints={@ORM\UniqueConstraint(name="boxId", columns={"box_id"})}, indexes={@ORM\Index(name="status", columns={"status"})})
 * @ORM\Entity
 */
class BoxGene
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="IL6", type="string", length=2, nullable=false)
     */
    private $il6;

    /**
     * @var string
     *
     * @ORM\Column(name="HLA-C", type="string", length=2, nullable=false)
     */
    private $hlaC;

    /**
     * @var string
     *
     * @ORM\Column(name="ZNF365", type="string", length=2, nullable=false)
     */
    private $znf365;

    /**
     * @var string
     *
     * @ORM\Column(name="MMP1", type="string", length=2, nullable=false)
     */
    private $mmp1;

    /**
     * @var string
     *
     * @ORM\Column(name="AQP3", type="string", length=2, nullable=false)
     */
    private $aqp3;

    /**
     * @var string
     *
     * @ORM\Column(name="NQO1", type="string", length=2, nullable=false)
     */
    private $nqo1;

    /**
     * @var string
     *
     * @ORM\Column(name="SOD2", type="string", length=2, nullable=false)
     */
    private $sod2;

    /**
     * @var string
     *
     * @ORM\Column(name="NFE2L2", type="string", length=2, nullable=false)
     */
    private $nfe2l2;

    /**
     * @var string
     *
     * @ORM\Column(name="CAT", type="string", length=2, nullable=false)
     */
    private $cat;

    /**
     * @var string
     *
     * @ORM\Column(name="MC1R", type="string", length=2, nullable=false)
     */
    private $mc1r;

    /**
     * @var string
     *
     * @ORM\Column(name="GSTP1", type="string", length=2, nullable=false)
     */
    private $gstp1;

    /**
     * @var string
     *
     * @ORM\Column(name="IRF4", type="string", length=2, nullable=false)
     */
    private $irf4;

    /**
     * @var integer
     *
     * @ORM\Column(name="box_id", type="integer", nullable=false)
     */
    private $boxId;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_time", type="datetime", nullable=false)
     */
    private $updateTime = '\'0000-00-00 00:00:00\'';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_time", type="datetime", nullable=false)
     */
    private $createTime;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set il6
     *
     * @param string $il6
     *
     * @return BoxGene
     */
    public function setIl6($il6)
    {
        $this->il6 = $il6;

        return $this;
    }

    /**
     * Get il6
     *
     * @return string
     */
    public function getIl6()
    {
        return $this->il6;
    }

    /**
     * Set hlaC
     *
     * @param string $hlaC
     *
     * @return BoxGene
     */
    public function setHlaC($hlaC)
    {
        $this->hlaC = $hlaC;

        return $this;
    }

    /**
     * Get hlaC
     *
     * @return string
     */
    public function getHlaC()
    {
        return $this->hlaC;
    }

    /**
     * Set znf365
     *
     * @param string $znf365
     *
     * @return BoxGene
     */
    public function setZnf365($znf365)
    {
        $this->znf365 = $znf365;

        return $this;
    }

    /**
     * Get znf365
     *
     * @return string
     */
    public function getZnf365()
    {
        return $this->znf365;
    }

    /**
     * Set mmp1
     *
     * @param string $mmp1
     *
     * @return BoxGene
     */
    public function setMmp1($mmp1)
    {
        $this->mmp1 = $mmp1;

        return $this;
    }

    /**
     * Get mmp1
     *
     * @return string
     */
    public function getMmp1()
    {
        return $this->mmp1;
    }

    /**
     * Set aqp3
     *
     * @param string $aqp3
     *
     * @return BoxGene
     */
    public function setAqp3($aqp3)
    {
        $this->aqp3 = $aqp3;

        return $this;
    }

    /**
     * Get aqp3
     *
     * @return string
     */
    public function getAqp3()
    {
        return $this->aqp3;
    }

    /**
     * Set nqo1
     *
     * @param string $nqo1
     *
     * @return BoxGene
     */
    public function setNqo1($nqo1)
    {
        $this->nqo1 = $nqo1;

        return $this;
    }

    /**
     * Get nqo1
     *
     * @return string
     */
    public function getNqo1()
    {
        return $this->nqo1;
    }

    /**
     * Set sod2
     *
     * @param string $sod2
     *
     * @return BoxGene
     */
    public function setSod2($sod2)
    {
        $this->sod2 = $sod2;

        return $this;
    }

    /**
     * Get sod2
     *
     * @return string
     */
    public function getSod2()
    {
        return $this->sod2;
    }

    /**
     * Set nfe2l2
     *
     * @param string $nfe2l2
     *
     * @return BoxGene
     */
    public function setNfe2l2($nfe2l2)
    {
        $this->nfe2l2 = $nfe2l2;

        return $this;
    }

    /**
     * Get nfe2l2
     *
     * @return string
     */
    public function getNfe2l2()
    {
        return $this->nfe2l2;
    }

    /**
     * Set cat
     *
     * @param string $cat
     *
     * @return BoxGene
     */
    public function setCat($cat)
    {
        $this->cat = $cat;

        return $this;
    }

    /**
     * Get cat
     *
     * @return string
     */
    public function getCat()
    {
        return $this->cat;
    }

    /**
     * Set mc1r
     *
     * @param string $mc1r
     *
     * @return BoxGene
     */
    public function setMc1r($mc1r)
    {
        $this->mc1r = $mc1r;

        return $this;
    }

    /**
     * Get mc1r
     *
     * @return string
     */
    public function getMc1r()
    {
        return $this->mc1r;
    }

    /**
     * Set gstp1
     *
     * @param string $gstp1
     *
     * @return BoxGene
     */
    public function setGstp1($gstp1)
    {
        $this->gstp1 = $gstp1;

        return $this;
    }

    /**
     * Get gstp1
     *
     * @return string
     */
    public function getGstp1()
    {
        return $this->gstp1;
    }

    /**
     * Set irf4
     *
     * @param string $irf4
     *
     * @return BoxGene
     */
    public function setIrf4($irf4)
    {
        $this->irf4 = $irf4;

        return $this;
    }

    /**
     * Get irf4
     *
     * @return string
     */
    public function getIrf4()
    {
        return $this->irf4;
    }

    /**
     * Set boxId
     *
     * @param integer $boxId
     *
     * @return BoxGene
     */
    public function setBoxId($boxId)
    {
        $this->boxId = $boxId;

        return $this;
    }

    /**
     * Get boxId
     *
     * @return integer
     */
    public function getBoxId()
    {
        return $this->boxId;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return BoxGene
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set updateTime
     *
     * @param \DateTime $updateTime
     *
     * @return BoxGene
     */
    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;

        return $this;
    }

    /**
     * Get updateTime
     *
     * @return \DateTime
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
    }

    /**
     * Set createTime
     *
     * @param \DateTime $createTime
     *
     * @return BoxGene
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;

        return $this;
    }

    /**
     * Get createTime
     *
     * @return \DateTime
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }
}
