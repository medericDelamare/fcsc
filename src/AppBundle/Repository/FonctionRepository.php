<?php


namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class FonctionRepository extends EntityRepository
{
    public function getMembresBureau(){
        return $this->createQueryBuilder('m')
            ->where('m.type like \'bureau\'')
            ->orderBy('m.ordre')
            ->getQuery()
            ->getResult();
    }

    public function getResponsables(){
        return $this->createQueryBuilder('m')
            ->where('m.type like \'responsable-equipe\'')
            ->orderBy('m.ordre')
            ->getQuery()
            ->getResult();
    }
}