<?php

namespace Brickstorm\SolidRBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

/**
 * Brickstorm\SolidRBundle\Entity\Action
 */
class Action
{
  
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var date $created_at
     */
    private $created_at;

    /**
     * @var datetime $updated_at
     */
    private $updated_at;

    /**
     * @var Application\Sonata\UserBundle\Entity\User
     */
    private $user;


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
     * Set created_at
     *
     * @param date $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return date 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    }

    /**
     * Get updated_at
     *
     * @return datetime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set user
     *
     * @param Application\Sonata\UserBundle\Entity\User $user
     */
    public function setUser(\Application\Sonata\UserBundle\Entity\User $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return Application\Sonata\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @var float $quantity
     */
    private $quantity;

    /**
     * @var boolean $is_daily
     */
    private $is_daily;

    /**
     * @var boolean $is_weekly
     */
    private $is_weekly;

    /**
     * @var boolean $is_monthly
     */
    private $is_monthly;

    /**
     * @var boolean $is_yearly
     */
    private $is_yearly;

    /**
     * @var boolean $is_public
     */
    private $is_public;

    /**
     * @var string $orderNumber
     */
    private $orderNumber;

    /**
     * @var decimal $amount
     */
    private $amount;

    /**
     * @var Brickstorm\SolidRBundle\Entity\Project
     */
    private $project;

    /**
     * @var JMS\Payment\CoreBundle\Entity\PaymentInstruction
     */
    private $paymentInstruction;

    /**
     * Set quantity
     *
     * @param float $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * Get quantity
     *
     * @return float 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set is_daily
     *
     * @param boolean $isDaily
     */
    public function setIsDaily($isDaily)
    {
        $this->is_daily = $isDaily;
    }

    /**
     * Get is_daily
     *
     * @return boolean 
     */
    public function getIsDaily()
    {
        return $this->is_daily;
    }

    /**
     * Set is_weekly
     *
     * @param boolean $isWeekly
     */
    public function setIsWeekly($isWeekly)
    {
        $this->is_weekly = $isWeekly;
    }

    /**
     * Get is_weekly
     *
     * @return boolean 
     */
    public function getIsWeekly()
    {
        return $this->is_weekly;
    }

    /**
     * Set is_monthly
     *
     * @param boolean $isMonthly
     */
    public function setIsMonthly($isMonthly)
    {
        $this->is_monthly = $isMonthly;
    }

    /**
     * Get is_monthly
     *
     * @return boolean 
     */
    public function getIsMonthly()
    {
        return $this->is_monthly;
    }

    /**
     * Set is_yearly
     *
     * @param boolean $isYearly
     */
    public function setIsYearly($isYearly)
    {
        $this->is_yearly = $isYearly;
    }

    /**
     * Get is_yearly
     *
     * @return boolean 
     */
    public function getIsYearly()
    {
        return $this->is_yearly;
    }

    /**
     * Set is_public
     *
     * @param boolean $isPublic
     */
    public function setIsPublic($isPublic)
    {
        $this->is_public = $isPublic;
    }

    /**
     * Get is_public
     *
     * @return boolean 
     */
    public function getIsPublic()
    {
        return $this->is_public;
    }

    /**
     * Set orderNumber
     *
     * @param string $orderNumber
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;
    }

    /**
     * Get orderNumber
     *
     * @return string 
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * Set amount
     *
     * @param decimal $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * Get amount
     *
     * @return decimal 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set project
     *
     * @param Brickstorm\SolidRBundle\Entity\Project $project
     */
    public function setProject(\Brickstorm\SolidRBundle\Entity\Project $project)
    {
        $this->project = $project;
    }

    /**
     * Get project
     *
     * @return Brickstorm\SolidRBundle\Entity\Project 
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set paymentInstruction
     *
     * @param JMS\Payment\CoreBundle\Entity\PaymentInstruction $paymentInstruction
     */
    public function setPaymentInstruction(\JMS\Payment\CoreBundle\Entity\PaymentInstruction $paymentInstruction)
    {
        $this->paymentInstruction = $paymentInstruction;
    }

    /**
     * Get paymentInstruction
     *
     * @return JMS\Payment\CoreBundle\Entity\PaymentInstruction 
     */
    public function getPaymentInstruction()
    {
        return $this->paymentInstruction;
    }
}