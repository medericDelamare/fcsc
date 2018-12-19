<?php


namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ActualiteRepository extends EntityRepository
{
    public function findPublishedActualiteOrderByPosition(){
        return $this->createQueryBuilder('a')
            ->where('a.publie = 1')
            ->orderBy('a.position', 'DESC')
            ->getQuery()
            ->getResult();
    }
}