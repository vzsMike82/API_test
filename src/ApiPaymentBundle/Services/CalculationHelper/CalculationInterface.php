<?php

namespace ApiPaymentBundle\Services\CalculationHelper;

interface CalculationInterface 
{
    const CREDIT_CARD_FEE = 0.1;
    const DIRECT_DEBIT_FEE = 0.07;
    
    const CREDIT_CARD = 'cc';
    const DIRECT_DEBIT = 'dd';
    
    /**
     * @param string $paymentType
     * @param float $amount
     * 
     * return float
     */
    public function charge($paymentType, $amount); 
}