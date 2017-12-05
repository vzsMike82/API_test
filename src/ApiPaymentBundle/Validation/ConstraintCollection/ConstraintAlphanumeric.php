<?php

namespace ApiPaymentBundle\Validation\ConstraintCollection;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ConstraintAlphanumeric extends Constraint
{
    public $message;

    public $code;
    
    public function getCode()
    {
        return $this->code;
    }
}
