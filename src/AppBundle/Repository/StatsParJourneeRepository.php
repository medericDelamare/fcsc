<?php
/**
 * Created by PhpStorm.
 * User: delamare
 * Date: 19/09/2017
 * Time: 23:04
 */

namespace AppBundle\Repository;


use AppBundle\Entity\StatsParJournee;
use Doctrine\ORM\EntityRepository;

class StatsParJourneeRepository extends EntityRepository
{
    public function findByCategOrderByJournee($categ){
        return $this->createQueryBuilder('c')
            ->join('c.equipe', 'e', 'WITH', 'e.id = c.equipe')
            ->where('e.categorie = :categ')
            ->orderBy('c.journee', 'ASC')
            ->setParameter('categ', $categ)
            ->getQuery()
            ->getResult();
    }

    public function findNbJourneeByCateg($categ){
        return $this->createQueryBuilder('s')
            ->select('s.journee')
            ->where('s.category = :categ')
            ->orderBy('s.journee', 'ASC')
            ->setParameter('categ', $categ)
            ->distinct()
            ->getQuery()
            ->getResult();
    }

    public function findLastJourneeByCateg($categ){
        return $this->createQueryBuilder('s')
            ->select('s.journee')
            ->where('s.category = :categ')
            ->orderBy('s.journee', 'ASC')
            ->setParameter('categ', $categ)
            ->setMaxResults(1)
            ->distinct()
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findByCategorie($categorie){
        return $this->createQueryBuilder('s')
            ->join('s.equipe','e','WITH', 'e.id = s.equipe')
            ->where('e.categorie = :categorie')
            ->setParameter('categorie',$categorie)
            ->getQuery()
            ->execute();
    }
}