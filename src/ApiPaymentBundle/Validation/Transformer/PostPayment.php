<?php

namespace ApiPaymentBundle\Validation\Transformer;

use ApiPaymentBundle\Validation\Models\PaymentDebitCardModel;
use ApiPaymentBundle\Validation\Models\PaymentCreditCardModel;
use ApiPaymentBundle\Validation\ErrorHandler\ErrorHandler;
use ApiPaymentBundle\Validation\Transformer\ModelValidationInterface;

class PostPayment extends ErrorHandler implements ModelValidationInterface
{
    const DIRECT_DEBIT = 'dd';
    const CREADIT_CARD = 'cc';

    /**
     * @param array $requestData
     * @return Object
     */
    public function setModelToValidate(array $requestData)
    {
        if (!isset($requestData['type'])) {
           $requestData['type'] =  '';
        }
        
        if (!isset($requestData['name'])) {
           $requestData['name'] = '';
        }
        
        if (!isset($requestData['cc'])) {
           $requestData['cc'] =  '';
        }
        
        if (!isset($requestData['ccv'])) {
           $requestData['ccv'] =  '';
        }
        
        if (!isset($requestData['expiry'])) {
           $requestData['expiry'] =  '';
        }
        
        if (!isset($requestData['iban'])) {
           $requestData['iban'] =  '';
        }
        
        if (isset($requestData['type']) && $requestData['type'] == self::DIRECT_DEBIT) {
            return $this->checkDirectDebit($requestData);
        } else {
            return $this->checkCreditCard($requestData);
        }
    }
    
    /**
     * @param array $requestData
     * @return PaymentDebitCardModel
     */
    protected function checkDirectDebit($requestData)
    {
        $deitCardModel = new PaymentDebitCardModel();
                
        return $deitCardModel
            ->setName($requestData['name'])
            ->setType($requestData['type'])
            ->setIban($requestData['iban'])
        ;
    }
    
    /**
     * @param array $requestData
     * @return PaymentCreditCardModel
     */
    protected function checkCreditCard($requestData)
    {
        $creditCardModel = new PaymentCreditCardModel();
        
        return $creditCardModel
            ->setName($requestData['name'])
            ->setType($requestData['type'])
            ->setCc($requestData['cc'])
            ->setCcv($requestData['ccv'])
            ->setExpiry($requestData['expiry'])
        ;
    }
    
     /**
     * @param array $errors
     * @return boolean|\Symfony\Component\HttpFoundation\Response
     */
    public function modelErrorHandling($errors = [])
    {
        return parent::modelErrorHandling($errors);
    }
}
