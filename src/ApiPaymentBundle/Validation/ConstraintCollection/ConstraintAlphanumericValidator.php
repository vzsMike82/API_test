<?php

namespace ApiPaymentBundle\Validation\ConstraintCollection;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ConstraintAlphanumericValidator extends ConstraintValidator
{
    /**
     * @param string $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {   
        if (!preg_match('/^[a-zA-Z0-9\_\-. ]+$/', $value, $matches) || empty($value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
        }
    }
}
