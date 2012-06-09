<?php

/*
 * This file is part of the BrickstormAmndrcBundle package.
 *
 * (c) Brickstorm <http://brickstorm.org/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Brickstorm\SolidRBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use JMS\Payment\CoreBundle\Entity\Payment;
use JMS\Payment\CoreBundle\PluginController\Result;
use JMS\Payment\CoreBundle\Plugin\Exception\ActionRequiredException;
use JMS\Payment\CoreBundle\Plugin\Exception\Action\VisitUrl;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Brickstorm\SolidRBundle\Entity\Action;

/**
 * @Route("/payments")
 */
class PaymentController extends Controller
{
    /** @DI\Inject */
    private $request;

    /** @DI\Inject */
    private $router;

    /** @DI\Inject("doctrine.orm.entity_manager") */
    private $em;

    /** @DI\Inject("payment.plugin_controller") */
    private $ppc;

    /**
     *
     */
    public function processAction($object)
    {
      
      $form = $this->get('form.factory')->create('jms_choose_payment_method', null, array(
          'currency' => 'EUR',
          'amount'   => $object->getAmount(),
          'predefined_data' => array(
              'paypal_express_checkout' => array(
                  'return_url' => $this->get('router')->generate('payment_complete', array(
                      'orderNumber' => $object->getOrderNumber(),
                  ), true),
                  'cancel_url' => $this->get('router')->generate('payment_cancel', array(
                      'orderNumber' => $object->getOrderNumber(),
                  ), true)
              ),
          ),
      ));

      if ('POST' === $request->getMethod()) {
          $form->bindRequest($request);

          if ($form->isValid()) {
              $this->ppc->createPaymentInstruction($instruction = $form->getData());

              $order->setPaymentInstruction($instruction);
              $this->em->persist($object);
              $this->em->flush($object);

              return new RedirectResponse($this->get('router')->generate('payment_complete', array(
                  'orderNumber' => $object->getOrderNumber(),
              )));
          }
      }

      return array(
          'form' => $form->createView()
      );
    }

    // ...

    /** @DI\LookupMethod("form.factory") */
    protected function getFormFactory() { }
}