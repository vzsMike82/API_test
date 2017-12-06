<?php

namespace ApiPaymentBundle\Validation\ConstraintCollection;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ConstraintCardTypeValidator extends ConstraintValidator
{
    const DIRECT_DEBIT = 'dd';
    const CREAIT_CARD = 'cc';
    
    /**
     * @param string $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {   
        if (!in_array($value, [self::DIRECT_DEBIT, self::CREAIT_CARD])) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
        }
    }
}