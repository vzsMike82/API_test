<?php

namespace ApiPaymentBundle\Validation\ErrorHandler;

interface ValidationErrorInterface 
{
    /**
     * @param array $errors
     * @return boolean|\Symfony\Component\HttpFoundation\Response
     */
    public function modelErrorHandling($errors);
}
