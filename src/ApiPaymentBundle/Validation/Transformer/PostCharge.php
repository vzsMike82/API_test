<?php

namespace ApiPaymentBundle\Validation\Transformer;

use ApiPaymentBundle\Validation\ErrorHandler\ErrorHandler;
use ApiPaymentBundle\Validation\Transformer\ModelValidationInterface;
use ApiPaymentBundle\Validation\Models\ChargeModel;
use Symfony\Component\HttpFoundation\Response;

/**
 * PostCharge
 */
class PostCharge extends ErrorHandler implements ModelValidationInterface
{
    /**
     * @param array $requestData
     * @return Object
     */
    public function setModelToValidate(array $requestData)
    {
        if (!isset($requestData['payment_id'])) {
           $requestData['payment_id'] =  '';
        }
        
        if (!isset($requestData['amount'])) {
           $requestData['amount'] =  '';
        } 
        
        $chargeModel = new ChargeModel();
        return $chargeModel->setAmount($requestData['amount'])
            ->setPaymentId($requestData['payment_id']);
    }
    
    /**
     * @param array $errors
     * @return Response
     */
    public function modelErrorHandling($errors = [])
    {
        return parent::modelErrorHandling($errors);
    }
}
