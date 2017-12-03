<?php

namespace ApiPaymentBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of ChargeController
 * @author Zsolt
 */
class ChargeController extends Controller
{
    /**
     * @Route(name="getcharge")
     */
    public function getAction()
    {
        return new Response('',200);
    }
    
    /**
     * @Route(name="postcharge") 
     */
    public function postAction()
    {
        return new Response('',200);
    }
    
    /**
     * @Route(name="getonecharge")
     */
    public function getOneAction($chargeId)
    {
        $id = \json_encode(['id' => $chargeId]);
        return new Response($id, 200);
    }
    
            
}