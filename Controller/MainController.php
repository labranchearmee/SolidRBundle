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
                  ->findBy(array('id'=> array(2,12,22)));
      
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
      //$ps  = $em->getRepository('BrickstormSolidRBundle:Project')
      //          ->findByCities(array(1));
      $ps  = $em->getRepository('BrickstormSolidRBundle:Project')
                ->findBy(array('parent'=>null));
      
      return $this->render('BrickstormSolidRBundle:Main:area.html.twig', array(
        'area' => $a,
        'projects' => $ps
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
}