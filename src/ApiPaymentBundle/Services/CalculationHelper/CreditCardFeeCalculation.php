<?php

namespace ApiPaymentBundle\Services\CalculationHelper;

use ApiPaymentBundle\Services\CalculationHelper\CalculationInterface;

class CreditCardFeeCalculation implements CalculationInterface
{
    /**
     * @param string $paymentType
     * @return float
     */
    public function charge($paymentType, $amount)
    {
        return round($amount * CalculationInterface::CREDIT_CARD_FEE, 2);
    }
}