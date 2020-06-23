<?php


namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class FonctionRepository extends EntityRepository
{
    public function getMembresBureau(){
        return $this->createQueryBuilder('m')
            ->where('m.type like \'bureau\'')
            ->getQuery()
            ->getResult();
    }

    public function getMembresBureauByCode($code){
        return $this->createQueryBuilder('m')
            ->where('m.type like \'bureau\'')
            ->andWhere('m.code = :code')
            ->setParameter('code', $code)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getResponsablesByType($type){
        return $this->createQueryBuilder('m')
            ->where('m.type = :type')
            ->setParameter('type', $type)
            ->getQuery()
            ->getResult();
    }
}