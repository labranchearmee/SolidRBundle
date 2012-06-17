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
      $ps  = $em->getRepository('BrickstormSolidRBundle:Project')
                ->findBy(array('parent'=>null));
      
      return $this->render('BrickstormSolidRBundle:Main:home.html.twig', array(
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
      
      return $this->render('BrickstormSolidRBundle:Payment:_modal.html.twig', array(
        'project'   => $p,
        'recurrent' => $request->get('recurrent'),
        'quantity'  => $request->get('quantity'),
      ));
    }
}