<?php

namespace ApiPaymentBundle\Validation\Transformer;

interface ModelValidationInterface 
{
    /**
     * @param array $requestData
     * @return Object
     */
    public function setModelToValidate(array $requestData);
    
     /**
     * @param array $errors
     * @return boolean|\Symfony\Component\HttpFoundation\Response
     */
    public function modelErrorHandling($errors = []);
}
