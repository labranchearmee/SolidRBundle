<?php

/*
 * This file is part of the BrickstormSolidRBundle package.
 *
 * (c) Brickstorm <http://brickstorm.org/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Brickstorm\SolidRBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Brickstorm\SolidRBundle\Entity\Action;

//use Brickstorm\SolidRBundle\Controller\PaymentController as BaseController;

/**
 * @Route("/payments")
 */
class PaymentController extends Controller //extends BaseController
{
    /**
     *
     */
    public function paypalAction(Request $request)
    {
      //print_r($_REQUEST);exit();
      if ($request->get('auth')) {
        
        //mail
        $message = \Swift_Message::newInstance()
                ->setSubject($this->get('translator')->trans('email.payment.success.title'))
                ->setFrom($this->get('translator')->trans('service.email'))
                ->setTo($values['email'])
                ->setBody($this->get('translator')->trans('email.payment.success.body'));
          $this->get('mailer')->send($message);
        
        return $this->render('BrickstormSolidRBundle:Payment:paypal.html.twig', array(
          'success' => true
        ));
      
      } else {

        //mail
        $message = \Swift_Message::newInstance()
                ->setSubject($this->get('translator')->trans('email.payment.failure.title'))
                ->setFrom($this->get('translator')->trans('service.email'))
                ->setTo($values['email'])
                ->setBody($this->get('translator')->trans('email.payment.failure.body'));
          $this->get('mailer')->send($message);

        return $this->render('BrickstormSolidRBundle:Payment:paypal.html.twig', array(
          'success' => false
        ));
      }
    }

    /**
     *
     */
    public function successAction(Request $request)
    {
      return $this->render('BrickstormSolidRBundle:Payment:success.html.twig');
    }

    /**
     *
     */
    public function processAction($object=null)
    {
      $em = $this->getDoctrine()->getEntityManager();
      $p  = $em->getRepository('BrickstormSolidRBundle:Project')
               ->findOneById($this->get('request')->get('id'));
      
      $object = new Action;
      $object->setProject($p);
      $object->setAmount(5);
      $object->setQuantity($this->get('request')->get('quantity', 1));

      $solidr = parent::processAction($object);
      if (is_array($solidr)) {
        return $this->render('BrickstormSolidRBundle:Payment:process.html.twig', $solidr);
      } else {
        return $solidr;
      }
      
    }

}