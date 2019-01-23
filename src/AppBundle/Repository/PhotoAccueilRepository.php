<?php


namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class PhotoAccueilRepository extends EntityRepository
{
    public function getLastPictures(){
        return $this->createQueryBuilder('p')
            ->orderBy('p.updated', 'DESC')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult();
    }
}