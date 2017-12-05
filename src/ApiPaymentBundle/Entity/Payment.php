<?php

namespace ApiPaymentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Payment
 *
 * @ORM\Table(name="payment")
 * @ORM\Entity(repositoryClass="ApiPaymentBundle\Repository\PaymentRepository")
 */
class Payment
{  
     /**
     * @ORM\OneToMany(targetEntity="Charge", mappedBy="payments")
     */
    protected $charges;
     
    public function __construct()
    {   
         $this->charges = new ArrayCollection();
         $this->created = new \DateTime();
    }
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=2)
     */
    private $type;

    /**
     * @var string,
     *
     * @ORM\Column(name="iban", type="string", length=30, nullable=true)
     */
    private $iban;

    /**
     * @var string,
     *
     * @ORM\Column(name="expiry", type="string", length=10, nullable=true)
     */
    private $expiry;

    /**
     * @var string
     *
     * @ORM\Column(name="cc", type="string", length=4, nullable=true)
     */
    private $cc;

    /**
     * @var string
     *
     * @ORM\Column(name="ccv", type="string", length=4, nullable=true)
     */
    private $ccv;
    
    /**
     * @var string
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
     * Set name
     *
     * @param string $name
     *
     * @return Payment
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
     * Set type
     *
     * @param string $type
     *
     * @return Payment
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set iban
     *
     * @param string $iban
     *
     * @return Payment
     */
    public function setIban($iban)
    {
        $this->iban = $iban;

        return $this;
    }

    /**
     * Get iban
     *
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * Set expiry
     *
     * @param string $expiry
     *
     * @return Payment
     */
    public function setExpiry($expiry)
    {
        $this->expiry = $expiry;

        return $this;
    }

    /**
     * Get expiry
     *
     * @return string
     */
    public function getExpiry()
    {
        return $this->expiry;
    }

    /**
     * Set cc
     *
     * @param string $cc
     *
     * @return Payment
     */
    public function setCc($cc)
    {
        $this->cc = $cc;

        return $this;
    }

    /**
     * Get cc
     *
     * @return string
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * Set ccv
     *
     * @param string $ccv
     *
     * @return Payment
     */
    public function setCcv($ccv)
    {
        $this->ccv = $ccv;

        return $this;
    }

    /**
     * Get ccv
     *
     * @return string
     */
    public function getCcv()
    {
        return $this->ccv;
    }

    /**
     * Set created
     *
     * @param \dateime $created
     *
     * @return Payment
     */
    public function setCreated(\dateime $created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \dateime
     */
    public function getCreated()
    {
        return $this->created;
    }
}
