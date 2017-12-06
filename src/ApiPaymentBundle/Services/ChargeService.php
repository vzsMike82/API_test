<?php

namespace ApiPaymentBundle\Services;

use Symfony\Component\DependencyInjection\Container;
use Doctrine\ORM\EntityManager;
use ApiPaymentBundle\Services\CalculationHelper\CalculationInterface;
use ApiPaymentBundle\Services\CalculationHelper\CreditCardFeeCalcualtion;
use ApiPaymentBundle\Services\CalculationHelper\DirectDebitFeeCalculation;
use ApiPaymentBundle\Entity\Charge;
use ApiPaymentBundle\Models\ChargeModel;

class ChargeService
{
    protected $em;
    protected $container;

    /**
     * @param EntityManager $entityManager
     * @param Container $container
     */
    public function __construct(EntityManager $entityManager, Container $container)
    {
        $this->em = $entityManager;
        $this->container = $container;
    }
    
    /**
     * @param array $requestData
     */
    public function setCharge($requestData)
    {
        $payment = $this->em->getRepository('ApiPaymentBundle:Payment')
            ->findOneById($requestData['payment_id']);

        $fee = 0;
        if ($payment->getType() == CalculationInterface::CREDIT_CARD) {
            $ccCalculation = new CreditCardFeeCalcualtion();
            $fee = $ccCalculation->charge(
                CalculationInterface::CREDIT_CARD, 
                $requestData['amount']
            );
        } 
        
        if ($payment->getType() == CalculationInterface::DIRECT_DEBIT) {
            $ccCalculation = new DirectDebitFeeCalculation();
            $fee = $ccCalculation->charge(
                CalculationInterface::DIRECT_DEBIT,
                $requestData['amount']
            );
        }
        
        $charge = new Charge();
        $charge->setAmount($requestData['amount'])
            ->setPayments($payment)
            ->setFee($fee);
        
        $this->em->persist($charge);
        $this->em->flush();
    }
    
    /**
     * @return type
     */
    public function setGetAll() 
    {
        $charges = $this->em->getRepository('ApiPaymentBundle:Charge')
            ->findAll();
        
        $allCharge = [];
        if(count($charges) > 0) {
            foreach($charges as $charge) {
                $data = [
                    'id' => $charge->getId(),
                    'amount' => $charge->getAmount() + $charge->getFee(),
                    'payment_id' => $charge->getPayments()->getId()
                ];
                $allCharge[] = new ChargeModel($data);
            }
        }
        return $allCharge;
    }
    
    /**
     * @param int $id
     * @return type
     */
     public function setGetOneCharge($id)
    {
        $charge = $this->em->getRepository('ApiPaymentBundle:Charge')
            ->find($id);

        $data = [
            'id' => $charge->getId(),
            'amount' => $charge->getAmount() + $charge->getFee(),
            'payment_id' => $charge->getPayments()->getId()
        ];

        return new ChargeModel($data);
    }
}
