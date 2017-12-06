<?php

namespace ApiPaymentBundle\Services;

use Doctrine\ORM\EntityManager;
use ApiPaymentBundle\Services\CalculationHelper\CalculationInterface;
use ApiPaymentBundle\Services\CalculationHelper\CreditCardFeeCalculation;
use ApiPaymentBundle\Services\CalculationHelper\DirectDebitFeeCalculation;
use ApiPaymentBundle\Entity\Charge;
use ApiPaymentBundle\Models\ChargeModel;
use Symfony\Component\HttpFoundation\Response;

class ChargeService
{
    protected $em;

    /**
     * @param EntityManager $entityManager
     * @param Container $container
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }
    
    /**
     * Calculate Charge and store in DB
     * 
     * @param array $requestData
     */
    public function setCharge($requestData)
    {
        $payment = $this->em->getRepository('ApiPaymentBundle:Payment')
            ->findOneById($requestData['payment_id']);

        $fee = 0;
        if ($payment->getType() == CalculationInterface::CREDIT_CARD) {
            $ccCalculation = new CreditCardFeeCalculation();
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
     * Fetch all Charges from DB
     * 
     * @return array
     */
    public function getAll() 
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
     * Fetch charge from DB by Id
     * 
     * @param int $id
     * @return type
     */
    public function getOneCharge($id)
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
    
    /**
     * @param string $entity
     * @param int $id
     * @return Response|null
     */
    public function hasEntity($entity, $id)
    {
       if(empty($this->em->getRepository('ApiPaymentBundle:' . $entity)->find($id))) {
           return $this->generalError($entity);
       }
       
       return null;
    }
    
    /**
     * @return Response
     */
    protected function generalError($entity)
    {
        $charge = [ 'error' => $entity . ' doesn\'t exist' ];
                
        return new Response(
            \json_encode($charge), 
            Response::HTTP_NOT_FOUND, 
            ['Content-Type' => 'application/json',]
        );
    }
}
