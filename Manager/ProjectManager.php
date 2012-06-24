<?php

namespace Brickstorm\SolidRBundle\Manager;

use Brickstorm\SolidRBundle\Entity\Project;
use Brickstorm\Sms4FoodBundle\Entity\Area;
use Brickstorm\WorldBundle\Entity\City;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;

class ProjectManager
{
    protected $em      = null;

    public function __construct(EntityManager $em){
      $this->em         = $em;
    }

    /**
    *
    */
    public function search($q)
    {
      $qb = $this->em->createQueryBuilder();
      $qb ->select(array('p'))
          ->from('BrickstormSolidRBundle:Project', 'p')
          ->join('p.cities', 'c')
          ->join('p.areas', 'a')
          ->add('where', $qb->expr()->orx(
             $qb->expr()->like('p.name', '?1'),
             $qb->expr()->like('c.name', '?1'),
             $qb->expr()->like('a.name', '?1')
          ))
          ->setParameter(1, '%'.$q.'%');
      $result = $qb->getQuery()->execute();
      
      return $result;
    }
}