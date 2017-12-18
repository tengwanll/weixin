<?php

namespace Mirror\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BoxInfo
 *
 * @ORM\Table(name="box_info", uniqueConstraints={@ORM\UniqueConstraint(name="boxId", columns={"box_id"})}, indexes={@ORM\Index(name="status", columns={"status"})})
 * @ORM\Entity
 */
class BoxInfo
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
     * @ORM\Column(name="box_id", type="integer", nullable=false)
     */
    private $boxId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="integer", nullable=false)
     */
    private $age;

    /**
     * @var integer
     *
     * @ORM\Column(name="gender", type="integer", nullable=false)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="telephone", type="integer", nullable=false)
     */
    private $telephone;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_ultraviolet", type="integer", nullable=false)
     */
    private $isUltraviolet = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="is_sensitive", type="integer", nullable=false)
     */
    private $isSensitive = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="is_oxidation", type="integer", nullable=false)
     */
    private $isOxidation = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="is_lock", type="integer", nullable=false)
     */
    private $isLock = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="is_stain", type="integer", nullable=false)
     */
    private $isStain = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="is_elasticity", type="integer", nullable=false)
     */
    private $isElasticity = '0';

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
     * Set boxId
     *
     * @param integer $boxId
     *
     * @return BoxInfo
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
     * Set name
     *
     * @param string $name
     *
     * @return BoxInfo
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
     * Set age
     *
     * @param integer $age
     *
     * @return BoxInfo
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set gender
     *
     * @param integer $gender
     *
     * @return BoxInfo
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return integer
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return BoxInfo
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telephone
     *
     * @param integer $telephone
     *
     * @return BoxInfo
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return integer
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set isUltraviolet
     *
     * @param integer $isUltraviolet
     *
     * @return BoxInfo
     */
    public function setIsUltraviolet($isUltraviolet)
    {
        $this->isUltraviolet = $isUltraviolet;

        return $this;
    }

    /**
     * Get isUltraviolet
     *
     * @return integer
     */
    public function getIsUltraviolet()
    {
        return $this->isUltraviolet;
    }

    /**
     * Set isSensitive
     *
     * @param integer $isSensitive
     *
     * @return BoxInfo
     */
    public function setIsSensitive($isSensitive)
    {
        $this->isSensitive = $isSensitive;

        return $this;
    }

    /**
     * Get isSensitive
     *
     * @return integer
     */
    public function getIsSensitive()
    {
        return $this->isSensitive;
    }

    /**
     * Set isOxidation
     *
     * @param integer $isOxidation
     *
     * @return BoxInfo
     */
    public function setIsOxidation($isOxidation)
    {
        $this->isOxidation = $isOxidation;

        return $this;
    }

    /**
     * Get isOxidation
     *
     * @return integer
     */
    public function getIsOxidation()
    {
        return $this->isOxidation;
    }

    /**
     * Set isLock
     *
     * @param integer $isLock
     *
     * @return BoxInfo
     */
    public function setIsLock($isLock)
    {
        $this->isLock = $isLock;

        return $this;
    }

    /**
     * Get isLock
     *
     * @return integer
     */
    public function getIsLock()
    {
        return $this->isLock;
    }

    /**
     * Set isStain
     *
     * @param integer $isStain
     *
     * @return BoxInfo
     */
    public function setIsStain($isStain)
    {
        $this->isStain = $isStain;

        return $this;
    }

    /**
     * Get isStain
     *
     * @return integer
     */
    public function getIsStain()
    {
        return $this->isStain;
    }

    /**
     * Set isElasticity
     *
     * @param integer $isElasticity
     *
     * @return BoxInfo
     */
    public function setIsElasticity($isElasticity)
    {
        $this->isElasticity = $isElasticity;

        return $this;
    }

    /**
     * Get isElasticity
     *
     * @return integer
     */
    public function getIsElasticity()
    {
        return $this->isElasticity;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return BoxInfo
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
     * @return BoxInfo
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
     * @return BoxInfo
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
