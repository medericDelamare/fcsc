<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
/**
 * Class Joueur
 *
 * @ORM\Entity()
 *
 */
class CarriereJoueur
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie", inversedBy="carriere")
     */
    private $licencie;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $saison;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $sousCategorie;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $clubParse;

    /**
     * @var Club
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Club")
     */
    private $club;
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSaison()
    {
        return $this->saison;
    }

    /**
     * @param string $saison
     * @return CarriereJoueur
     */
    public function setSaison($saison)
    {
        $this->saison = $saison;
        return $this;
    }

    /**
     * @return string
     */
    public function getSousCategorie()
    {
        return $this->sousCategorie;
    }

    /**
     * @param string $sousCategorie
     * @return CarriereJoueur
     */
    public function setSousCategorie($sousCategorie)
    {
        $this->sousCategorie = $sousCategorie;
        return $this;
    }

    /**
     * @return string
     */
    public function getClubParse()
    {
        return $this->clubParse;
    }

    /**
     * @param string $clubParse
     * @return CarriereJoueur
     */
    public function setClubParse($clubParse)
    {
        $this->clubParse = $clubParse;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getLicencie()
    {
        return $this->licencie;
    }

    /**
     * @param Licencie $licencie
     * @return CarriereJoueur
     */
    public function setLicencie($licencie)
    {
        $this->licencie = $licencie;
        return $this;
    }

    /**
     * @return Club
     */
    public function getClub()
    {
        return $this->club;
    }

    /**
     * @param Club $club
     * @return CarriereJoueur
     */
    public function setClub($club)
    {
        $this->club = $club;
        return $this;
    }
}