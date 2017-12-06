<?php

namespace ApiPaymentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPaymentBundle\Entity\Payment;

/**
 * Charge
 *
 * @ORM\Table(name="charge")
 * @ORM\Entity(repositoryClass="ApiPaymentBundle\Repository\ChargeRepository")
 */
class Charge
{
    public function __construct()
    {   
        //$this->created = new \DateTime();

    }
    
     /**
     * @ORM\ManyToOne(targetEntity="Payment", inversedBy="charges")
     * @ORM\JoinColumn(name="payment_id", referencedColumnName="id")
     */
    protected $payments;
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float,
     *
     * @ORM\Column(name="amount", type="decimal", scale=2, nullable=true)
     */
    private $amount;
    
    /**
     * @var float,
     *
     * @ORM\Column(name="fee", type="decimal", scale=2, nullable=true)
     */
    private $fee;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created;

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
     * Set amount
     *
     * @param string $amount
     *
     * @return Charge
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Charge
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set fee
     *
     * @param string $fee
     *
     * @return Charge
     */
    public function setFee($fee)
    {
        $this->fee = $fee;

        return $this;
    }

    /**
     * Get fee
     *
     * @return string
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * Set payments
     *
     * @param Payment $payments
     *
     * @return Charge
     */
    public function setPayments(Payment $payments = null)
    {
        $this->payments = $payments;

        return $this;
    }

    /**
     * Get payments
     *
     * @return Payment
     */
    public function getPayments()
    {
        return $this->payments;
    }
}
