<?php

namespace ApiPaymentBundle\Controller\Base;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ApiPaymentBundle\Validation\ErrorHandler\ErrorHandler;

/**
 * BaseController
 */
class BaseController extends Controller
{
    /**
     * @param array $requestData
     * @param Object $validator
     * @return null|array
     */
    protected function validate($requestData, $validator)
    {
        $errors = $this->get('validator')
            ->validate($validator->setModelToValidate($requestData));
        
        $errorHandler = new ErrorHandler();
        
        return $errorHandler->modelErrorHandling($errors);
   }
   
   /**
    * @return PaymentService
    */
   protected function paymentService()
   {
       return $this->container->get('api_payment');
   }
   
   /**
    * @return ChargeService
    */
   protected function chargeService()
   {
       return $this->container->get('api_payment.charge');
   }
}
