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

class OrganizationController extends Controller
{

    /**
    *
    */
    public function organizationAction(Request $request)
    {
      
      $em = $this->getDoctrine()->getEntityManager();
      $o  = $em->getRepository('BrickstormSolidRBundle:Organization')
               ->findOneById($request->get('id'));

      // -- map
      $map = $this->getOrganizationMap($o);
      

      return $this->render('BrickstormSolidRBundle:Organization:organization.html.twig', array(
        'organization' => $o,
        'map'     => $map
      ));
    }

    /**
    *
    */
    public function getOrganizationMap(Organization $o)
    {
      $map = $this->get('ivory_google_map.map');
      $map->setPrefixJavascriptVariable('map_');
      $map->setHtmlContainerId('map_canvas');
      $map->setAsync(false);

      $map->setMapOptions(array(
          //'disableDefaultUI' => true,
          //'disableDoubleClickZoom' => true,
          'mapTypeId' => 'satellite',//'roadmap',
          'zoom' => 5
      ));
      $map->setStylesheetOptions(array(
          'width' => '500px',
          'height' => '375px',
      ));
      //$map->setAutoZoom(true);
      //$map->setBound(-2.1, -3.9, 2.6, 1.4, true, true);
      //$map->setLanguage('en');
      
      
      // -- markers
      foreach ($o->getProjects() as $p) {
        foreach ($p->getCities() as $city) {
          $marker = $this->get('ivory_google_map.marker');
          $marker->setPrefixJavascriptVariable('marker_');
          $marker->setPosition($city->getLatitude(), $city->getLongitude(), true);
          $marker->setAnimation(Animation::DROP);
          $marker->setOptions(array(
              'clickable' => false,
              'flat' => true
          ));
  
  
          $map->setCenter($city->getLatitude(), $city->getLongitude(), true); 
          $map->addMarker($marker);
        }
      }
      
      return $map;
    }
}