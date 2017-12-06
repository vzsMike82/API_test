<?php

namespace ApiPaymentBundle\Models;

class ChargeModel 
{
    public $id;
    
    public $payment_id;
    
    public $amount;
    
    private $allowedFields = [
        'id',
        'payment_id',
        'amount',
    ];
    
    /**
     * 
     * @param array $data
     */
    public function __construct(array $data) 
    {
       $this->setModelFields($data);
    }
    
    public function setModelFields($data)
    {
        if(!empty($data)) {
            foreach($data as $fieldKey => $field) {
                if(in_array($fieldKey, $this->allowedFields)) {
                    $this->{$fieldKey} = $field;
                }
            }
            unset($this->allowedFields);
       }
    }
}
