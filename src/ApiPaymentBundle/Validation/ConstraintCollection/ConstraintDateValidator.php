<?php

namespace ApiPaymentBundle\Validation\ConstraintCollection;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ConstraintDateValidator extends ConstraintValidator
{  
    /**
     * @param string $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        $dateTime = \DateTime::createFromFormat("Y-m-d", $value);
        $dateTime !== false && !array_sum($dateTime->getLastErrors());
        
        $explodedDate = explode('-', $value);
        $dateCheck = \checkdate($explodedDate[1], $explodedDate[2], $explodedDate[0]);
        
        if (!$dateTime || (empty($value) || !$dateCheck)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $this->formatValue($value))
                ->addViolation();
        }
    }
}
