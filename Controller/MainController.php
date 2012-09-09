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
//use Symfony\Component\HttpFoundation\Response;

use Ivory\GoogleMapBundle\Model\Overlays\Animation;

use Brickstorm\SolidRBundle\Entity\Project;
use Brickstorm\SolidRBundle\Entity\Organization;
use Brickstorm\SolidRBundle\Entity\Action;

use Brickstorm\SolidRBundle\Manager\ProjectManager;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\MinLength;
use Symfony\Component\Validator\Constraints\MaxLength;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Min;
use Symfony\Component\Validator\Constraints\Max;
use Symfony\Component\Validator\Constraints\Collection;

class MainController extends Controller
{
    /**
    *
    */
    public function homeAction(Request $request)
    {
      
      $em = $this->getDoctrine()->getEntityManager();
      //$ps  = $em->getRepository('BrickstormSolidRBundle:Project')
      //          ->findByCities(array(1));
      $samples  = $em->getRepository('BrickstormSolidRBundle:Project')
                  ->findBy(array('id'=> array(2,12,22,13,23)));
      
      return $this->render('BrickstormSolidRBundle:Main:home.html.twig', array(
        'samples' => $samples
      ));
    }

    /**
    *
    */
    public function areaAction(Request $request)
    {
      
      $em = $this->getDoctrine()->getEntityManager();
      $a  = $em->getRepository('BrickstormSolidRBundle:Area')
               ->findOneBySlug($request->get('slug'));
      $q = $em->createQuery('SELECT p '.
                            'FROM BrickstormSolidRBundle:Project p '.
                            'JOIN p.areas a '.
                            'WHERE a.slug = ?1 '.
                            'AND p.parent IS NULL '.
                            'ORDER BY p.id ASC')
              ->setParameter(1, $request->get('slug'));
      
      return $this->render('BrickstormSolidRBundle:Main:area.html.twig', array(
        'area' => $a,
        'projects' => $q->getResult()
      ));
    }

    /**
    *
    */
    public function searchAction(Request $request)
    {
      $q  = $request->get('q');

      $pm = new ProjectManager($this->getDoctrine()->getEntityManager());
      $ps = $pm->search($q);

      return $this->render('BrickstormSolidRBundle:Main:search.html.twig', array(
        'query' => $q,
        'projects' => $ps
      ));
    }

    /**
     *
     */
    public function modalAction(Request $request)
    {
      $em = $this->getDoctrine()->getEntityManager();
      $p  = $em->getRepository('BrickstormSolidRBundle:Project')
               ->findOneById($request->get('id'));

      $a = new Action;
      $a->setProject($p);
      $a->setQuantity($request->get('quantity'));
      $a->setReccurrent($request->get('recurrent'));

      return $this->render('BrickstormSolidRBundle:Payment:_modal.html.twig', array(
        'project' => $p,
        'action' => $a,
      ));
    }

    public function cgvuAction(Request $request)
    {
      return $this->render('BrickstormSolidRBundle:Main:cgvu.html.twig');
    }

    public function apiAction(Request $request)
    {
      return $this->render('BrickstormSolidRBundle:Main:api.html.twig');
    }

    public function joinUsAction(Request $request)
    {
      return $this->render('BrickstormSolidRBundle:Main:joinUs.html.twig');
    }

    public function contactUsAction(Request $request)
    {

      //form validation
      $collectionConstraint = new Collection(array(
          'email'       => new Email,
          'phonenumber' => array(new Min(33100000001), new Max(33999999998)),
          'subject'     => new MinLength(3),
          'message'     => array(new MinLength(10), new Regex('/((.*) (.*))+/'),),
      ));
      //form
      $form = $this->createFormBuilder(null, array('validation_constraint' => $collectionConstraint))
                   ->add('email', 
                         'email', 
                         array('required' => true))
                   ->add('phonenumber', 
                         'text', 
                         array('required' => false, 
                               'attr' => array('placeholder' => $this->get('translator')->trans('form.placeholder.phonenumber')),
                                               'max_length'  => 11))
                   ->add('subject', 
                         'text', 
                         array('required'  => true))
                   ->add('message', 
                         'textarea', 
                         array('required'  => true))
                   ->getForm();

      if ($request->getMethod() == 'POST') {
        $form->bindRequest($request);
        if ($form->isValid()) {
         $values = $form->getData();
         $message = \Swift_Message::newInstance()
                ->setSubject('[SolidR][ContactUs] '.$values['email'])
                ->setFrom($values['email'])
                ->setTo('contact@amndrc.org')
                ->setBody(print_r($values, true));
          $this->get('mailer')->send($message);
          
          $this->get('session')->setFlash('success', $this->get('translator')->trans('notice.contact.us'));
          return $this->redirect($this->get('router')->generate('homepage'));
        }
      }

      return $this->render('BrickstormSolidRBundle:Main:contactUs.html.twig', array(
        'form' => $form->createView(),
      ));
    }
}