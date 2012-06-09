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

class MainController extends Controller
{
    /**
    *
    */
    public function homeAction(Request $request)
    {
      return $this->render('BrickstormSolidRBundle:Main:home.html.twig', array(
      ));
    }
}