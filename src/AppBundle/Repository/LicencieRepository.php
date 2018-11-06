<?php


namespace AppBundle\Repository;


use AppBundle\Entity\Categorie;
use AppBundle\Entity\Licencie;
use AppBundle\Entity\SousCategorie;
use AppBundle\Entity\StatsJoueur;
use Doctrine\ORM\EntityRepository;

class LicencieRepository extends EntityRepository
{
    public function findByCategory($category){
        return $this->createQueryBuilder('j')
            ->leftjoin(SousCategorie::class, 'sc', 'WITH', 'sc.nom = j.categorie')
            ->leftjoin(Categorie::class, 'c', 'WITH', 'sc.categorie = c.id')
            ->where('c.nom LIKE :category')
            ->setParameter('category', $category)
            ->getQuery()
            ->getResult();
    }

    public function findByCategoryOrderByPoste($category){
        return $this->createQueryBuilder('j')
            ->leftjoin(StatsJoueur::class, 's', 'WITH', 's.id = j.stats')
            ->leftjoin(SousCategorie::class, 'sc', 'WITH', 'sc.nom = j.categorie')
            ->leftjoin(Categorie::class, 'c', 'WITH', 'sc.categorie = c.id')
            ->where('c.nom LIKE :category')
            ->andWhere('s.poste IS NOT NULL')
            ->setParameter('category', $category)
            ->getQuery()
            ->getResult();
    }


    public function findBirthday(){
        $now = new \DateTime();
        return $this->createQueryBuilder('j')
            ->where('DAY(j.dateDeNaissance) = :day')
            ->andWhere('MONTH(j.dateDeNaissance) = :month')
            ->setParameters(['day'=>$now->format('d'), 'month' => $now->format('m')])
            ->getQuery()
            ->getResult();


    }
}