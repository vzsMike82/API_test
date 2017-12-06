<?php

namespace ApiPaymentBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use ApiPaymentBundle\Controller\Base\BaseController;
use ApiPaymentBundle\Validation\Transformer\PostCharge;

/**
 * ChargeController
 */
class ChargeController extends BaseController
{
    /**
     * @Route(name="getcharge")
     */
    public function getAction()
    {
        $charges = $this->chargeService()->getAll();
        
        return new Response(json_encode($charges), Response::HTTP_OK);
    }
    
    /**
     * @Route(name="postcharge") 
     */
    public function postAction()
    {
        $request = $this->get('request_stack')->getCurrentRequest();
        $requestData = json_decode($request->getContent(), true);

        $errors = $this->validate($requestData, new PostCharge());
        if (!empty($errors)) {
            return $errors;
        }
        $hasEntityError = $this->chargeService()->hasEntity(
            'Payment', 
            isset($requestData['payment_id']) ? $requestData['payment_id'] : 0
        );
          
        if(!empty($hasEntityError)) {
            return $hasEntityError;
        }
        
        $this->chargeService()->setCharge($requestData);

        return new Response('', Response::HTTP_OK);
    }
    
    /**
     * @Route(name="getonecharge")
     */
    public function getOneAction($chargeId)
    {
        $hasEntityError = $this->chargeService()->hasEntity(
            'Charge', 
            $chargeId
        );
        
        if(!empty($hasEntityError)) {
            return $hasEntityError;
        }
        
        $charges = $this->chargeService()->getOneCharge($chargeId);
        
        return new Response(json_encode($charges), Response::HTTP_OK);
    }      
}
