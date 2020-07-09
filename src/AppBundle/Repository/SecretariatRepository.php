<?php


namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class SecretariatRepository extends EntityRepository
{
    public function getFirst(){
        return $this->createQueryBuilder('s')
            ->getQuery()
            ->setMaxResults(1)
            ->getOneOrNullResult();
    }
}