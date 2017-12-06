<?php

namespace ApiPaymentBundle\Services\CalculationHelper;

use ApiPaymentBundle\Services\CalculationHelper\CalculationInterface;

class DirectDebitFeeCalculation implements CalculationInterface
{
    public function charge($paymentType, $amount)
    {
        return round($amount * CalculationInterface::DIRECT_DEBIT_FEE, 2);
    }
}
