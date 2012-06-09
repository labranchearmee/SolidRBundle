<?php

namespace Brickstorm\SolidRBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ProjectRepository extends EntityRepository
{
    public function findByCities($cities_ids)
    {
      $qb = $this->getEntityManager()->createQueryBuilder();
      $qb ->select(array('p'))
          ->from('BrickstormSolidRBundle:Project', 'p')
          ->join('p.cities', 'c', 'WITH', $qb->expr()->in('c.id', $cities_ids))
          ;
      $result = $qb->getQuery()->execute();
      
      return $result;
    }
}

?>