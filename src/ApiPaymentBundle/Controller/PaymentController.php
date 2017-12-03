<?php

namespace ApiPaymentBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PaymentController extends Controller
{
    /**
     * @Route(name="makeapayment")
     */
    public function postAction()
    {
        return new Response('payment',200);
    }
}