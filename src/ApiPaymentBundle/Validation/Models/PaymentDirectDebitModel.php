<?php

namespace ApiPaymentBundle\Validation\Models;

use Symfony\Component\Validator\Constraints as Assert;
use \ApiPaymentBundle\Validation\ConstraintCollection as ModelAssert;

class PaymentDirectDebitModel
{
    /**
     * @ModelAssert\ConstraintAlphanumeric(code="400", message="Invalid parameter \name\")
    */
    protected $name;
    
    /**
     * @ModelAssert\ConstraintCardType(code="400", message="Invalid parameter \type\ ")
    */
    protected $type;
    
    /**
     * @ModelAssert\ConstraintAlphanumeric(code="400", message="Invalid parameter \iban\ ")
    */
    protected $iban;
    
    public function getName() 
    {
        return $this->name;
    }

    public function getType() 
    {
        return $this->type;
    }

    public function getIban() 
    {
        return $this->iban;
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

    public function setIban($iban) 
    {
        $this->iban = $iban;
        
        return $this;
    }

}