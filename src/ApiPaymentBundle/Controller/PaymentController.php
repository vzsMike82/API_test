<?php

namespace ApiPaymentBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use ApiPaymentBundle\Controller\Base\BaseController;
use ApiPaymentBundle\Validation\Transformer\PostPayment;

/**
 * PaymentController
 */
class PaymentController extends BaseController
{
    /**
     * @Route(name="makeapayment")
     */
    public function postAction()
    {
        $request = $this->get('request_stack')->getCurrentRequest();
        $requestData = json_decode($request->getContent(), true);

        $errors = $this->validate($requestData, new PostPayment());
        if (!empty($errors)) {
            return $errors;
        }

        $this->paymentService()->setPayment($requestData);
        
        return new Response('', Response::HTTP_OK);
    }
}
