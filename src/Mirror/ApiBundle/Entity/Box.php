<?php

namespace Mirror\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Box
 *
 * @ORM\Table(name="box", uniqueConstraints={@ORM\UniqueConstraint(name="uniqueId", columns={"unique_id"})}, indexes={@ORM\Index(name="status", columns={"status"})})
 * @ORM\Entity
 */
class Box
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
     * @var integer
     *
     * @ORM\Column(name="unique_id", type="integer", nullable=false)
     */
    private $uniqueId;

    /**
     * @var string
     *
     * @ORM\Column(name="code_url", type="string", length=255, nullable=false)
     */
    private $codeUrl;

    /**
     * @var integer
     *
     * @ORM\Column(name="report", type="integer", nullable=true)
     */
    private $report = 'NULL';

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
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address = 'NULL';



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
     * Set uniqueId
     *
     * @param integer $uniqueId
     *
     * @return Box
     */
    public function setUniqueId($uniqueId)
    {
        $this->uniqueId = $uniqueId;

        return $this;
    }

    /**
     * Get uniqueId
     *
     * @return integer
     */
    public function getUniqueId()
    {
        return $this->uniqueId;
    }

    /**
     * Set codeUrl
     *
     * @param string $codeUrl
     *
     * @return Box
     */
    public function setCodeUrl($codeUrl)
    {
        $this->codeUrl = $codeUrl;

        return $this;
    }

    /**
     * Get codeUrl
     *
     * @return string
     */
    public function getCodeUrl()
    {
        return $this->codeUrl;
    }

    /**
     * Set report
     *
     * @param integer $report
     *
     * @return Box
     */
    public function setReport($report)
    {
        $this->report = $report;

        return $this;
    }

    /**
     * Get report
     *
     * @return integer
     */
    public function getReport()
    {
        return $this->report;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Box
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
     * @return Box
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
     * @return Box
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

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Box
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }
}
