<?php

namespace ApiPaymentBundle\Validation\Models;

use Symfony\Component\Validator\Constraints as Assert;
use \ApiPaymentBundle\Validation\ConstraintCollection as ModelAssert;

class PaymentCreditCardModel
{
    /**
     * @ModelAssert\ConstraintAlphanumeric(code="400", message="Invalid parameter \name\")
    */
    protected $name;
    
    /**
     * @ModelAssert\ConstraintCardType(code="400", message="Invalid parameter \type\")
     */
    protected $type;
    
    /**
     * @ModelAssert\ConstraintDate(code="400", message="Invalid parameter \expiry\ Format:Y-m-d")
     */
    protected $expiry;
    
    /**
     *  @ModelAssert\ConstraintAlphanumeric(code="400", message="Invalid parameter \cc\")
     */
    protected $cc;
     
    /**
     *  @ModelAssert\ConstraintAlphanumeric(code="400", message="Invalid parameter \ccv\")
     */
    protected $ccv;
    
    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getExpiry()
    {
        return $this->expiry;
    }

    public function getCc() 
    {
        return $this->cc;
    }

    public function getCcv() 
    {
        return $this->ccv;
    }

    public function setName($name) 
    {
        $this->name = $name;
        
        return $this;
    }

    public function setType($type) 
    {
        $this->type = $type;
                
        return $this;
    }

    public function setExpiry($expiry) 
    {
        $this->expiry = $expiry;
        
        return $this;
    }

    public function setCc($cc) 
    {
        $this->cc = $cc;
        
        return $this;
    }

    public function setCcv($ccv) 
    {
        $this->ccv = $ccv;
        
        return $this;
    }
}
