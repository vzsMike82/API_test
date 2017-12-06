<?php

namespace ApiPaymentBundle\Validation\Models;

use Symfony\Component\Validator\Constraints as Assert;
use \ApiPaymentBundle\Validation\ConstraintCollection as ModelAssert;

class ChargeModel 
{
    /**
     * @ModelAssert\ConstraintAlphanumeric(code="400", message="Invalid parameter \payment_id\")
     */
    protected $paymentId;
    
    /**
     * @ModelAssert\ConstraintAlphanumeric(code="400", message="Invalid parameter \amount\")
     */
    protected $amount;
    
    public function getPaymentId() 
    {
        return $this->paymentId;
    }

    public function getAmount() 
    {
        return $this->amount;
    }

    function setPaymentId($paymentId) 
    {
        $this->paymentId = $paymentId;
        
        return $this;
    }

    function setAmount($amount) 
    {
        $this->amount = $amount;
        
        return $this;
    } 
}
