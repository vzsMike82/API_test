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
        $request = $this->get('request_stack')->getCurrentRequest();
        $requestData = json_decode($request->getContent(), true);
        
        $chargeService = $this->container->get('api_payment.charge');
        $charges = $chargeService->setGetAll();
        
        $data = json_encode($charges);
        
        return new Response($data, Response::HTTP_OK);
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

        $chargeService = $this->container->get('api_payment.charge');
        $chargeService->setCharge($requestData);

        return new Response('', Response::HTTP_OK);
    }
    
    /**
     * @Route(name="getonecharge")
     */
    public function getOneAction($chargeId)
    {
        $chargeService = $this->container->get('api_payment.charge');
        $charges = $chargeService->setGetOneCharge($chargeId);
        
        $data = json_encode($charges);
        
        return new Response($data, Response::HTTP_OK);
        return new Response($id, 200);
    }      
}
