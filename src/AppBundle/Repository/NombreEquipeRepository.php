<?php


namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class NombreEquipeRepository extends EntityRepository
{
    public function findAllOrdered(){
        return $this->createQueryBuilder('nb')
            ->orderBy('nb.ordre')
            ->getQuery()
            ->getResult();
    }
}