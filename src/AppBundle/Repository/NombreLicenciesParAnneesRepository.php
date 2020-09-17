<?php
namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class NombreLicenciesParAnneesRepository extends EntityRepository
{
    public function getAllOrderByAnneeDebut(){
        return $this->createQueryBuilder('nb')
            ->orderBy('nb.anneeDepart')
            ->getQuery()
            ->getResult();
    }
}