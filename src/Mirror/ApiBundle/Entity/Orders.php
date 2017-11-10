<?php

namespace Mirror\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 *
 * @ORM\Table(name="orders", uniqueConstraints={@ORM\UniqueConstraint(name="orderNo", columns={"order_no"})}, indexes={@ORM\Index(name="user", columns={"user_id"}), @ORM\Index(name="status", columns={"status"})})
 * @ORM\Entity
 */
class Orders
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="goods_id", type="integer", nullable=false)
     */
    private $goodsId;

    /**
     * @var string
     *
     * @ORM\Column(name="order_no", type="string", length=100, nullable=false)
     */
    private $orderNo;

    /**
     * @var string
     *
     * @ORM\Column(name="trade_no", type="string", length=100, nullable=true)
     */
    private $tradeNo = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=11, scale=2, nullable=false)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=false)
     */
    private $address;

    /**
     * @var integer
     *
     * @ORM\Column(name="pay_time", type="integer", nullable=true)
     */
    private $payTime = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="remark", type="text", length=65535, nullable=true)
     */
    private $remark = 'NULL';

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
     * @ORM\Column(name="create_time", type="datetime", nullable=false)
     */
    private $createTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_time", type="datetime", nullable=false)
     */
    private $updateTime = '\'0000-00-00 00:00:00\'';



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
     * Set name
     *
     * @param string $name
     *
     * @return Orders
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Orders
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set goodsId
     *
     * @param integer $goodsId
     *
     * @return Orders
     */
    public function setGoodsId($goodsId)
    {
        $this->goodsId = $goodsId;

        return $this;
    }

    /**
     * Get goodsId
     *
     * @return integer
     */
    public function getGoodsId()
    {
        return $this->goodsId;
    }

    /**
     * Set orderNo
     *
     * @param string $orderNo
     *
     * @return Orders
     */
    public function setOrderNo($orderNo)
    {
        $this->orderNo = $orderNo;

        return $this;
    }

    /**
     * Get orderNo
     *
     * @return string
     */
    public function getOrderNo()
    {
        return $this->orderNo;
    }

    /**
     * Set tradeNo
     *
     * @param string $tradeNo
     *
     * @return Orders
     */
    public function setTradeNo($tradeNo)
    {
        $this->tradeNo = $tradeNo;

        return $this;
    }

    /**
     * Get tradeNo
     *
     * @return string
     */
    public function getTradeNo()
    {
        return $this->tradeNo;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Orders
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Orders
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

    /**
     * Set payTime
     *
     * @param integer $payTime
     *
     * @return Orders
     */
    public function setPayTime($payTime)
    {
        $this->payTime = $payTime;

        return $this;
    }

    /**
     * Get payTime
     *
     * @return integer
     */
    public function getPayTime()
    {
        return $this->payTime;
    }

    /**
     * Set remark
     *
     * @param string $remark
     *
     * @return Orders
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;

        return $this;
    }

    /**
     * Get remark
     *
     * @return string
     */
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * Set report
     *
     * @param integer $report
     *
     * @return Orders
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
     * @return Orders
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
     * Set createTime
     *
     * @param \DateTime $createTime
     *
     * @return Orders
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
     * Set updateTime
     *
     * @param \DateTime $updateTime
     *
     * @return Orders
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
}
