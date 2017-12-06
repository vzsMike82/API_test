<?php
namespace ApiPaymentBundle\Services;

use Doctrine\ORM\EntityManager;
use ApiPaymentBundle\Entity\Payment;

/**
 * Payment Service
 */
class PaymentService 
{
    protected $em;

    /**
     * 
     * @param EntityManager $entityManager
     * @param Container $container
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }
    
    /**
     * Store Payment Object in DB
     * 
     * @param aray $payment
     * @return Payment
     */
    public function setPayment($payment)
    {
        $newPayment = new Payment();
        $newPayment
            ->setName($payment['name'])
            ->setType($payment['type']);
        
        if($payment['type'] == 'cc') {
            $newPayment
                ->setCc($payment['cc'])
                ->setCcv($payment['ccv'])
                ->setExpiry($payment['expiry'])
            ;
        } else {
            $newPayment->setIban($payment['iban']);
        }
        
        $this->em->persist($newPayment);
        $this->em->flush();
        
        return $newPayment;
    }
}
