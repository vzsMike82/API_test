<?php

namespace ApiPaymentBundle\Validation\ErrorHandler;

use ApiPaymentBundle\Validation\ErrorHandler\ValidationErrorInterface;
use Symfony\Component\HttpFoundation\Response;

class ErrorHandler implements ValidationErrorInterface
{
    /**
     * 
     * @param array $errors
     * @return Response
     */
    public function modelErrorHandling($errors)
    {
        $errorMessage = null;
        if (count($errors) > 0) {
            foreach($errors as $error ) {
                $errorMessage['errors'][] = [
                    'message' => isset($error->getConstraint()->message) 
                        ? $error->getConstraint()->message  : "Invalid Parameter",
                    'code' => isset($error->getConstraint()->code) 
                        ? $error->getConstraint()->code  : "400",
                    ];
                }
                
            return new Response(
                \json_encode($errorMessage), 
                Response::HTTP_BAD_REQUEST, 
                ['Content-Type' => 'application/json',]
            );
        }
        
        return $errorMessage;
    }
}
