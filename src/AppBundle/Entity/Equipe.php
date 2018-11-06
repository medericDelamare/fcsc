<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Equipe
 * @package AppBundle\Entity
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EquipeRepository")
 */
class Equipe
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $logo;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $nomParse;


    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $nom;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $division;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $categorie;

    /** @ORM\Embedded(class = "AppBundle\Entity\StatsEquipe") */
    private $stats;

    /**
     * @var Club
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Club")
     * @ORM\JoinColumn(nullable=true)
     */
    private $club;

    public function __construct($categorie = null, $nomParse)
    {
        $this->nomParse = $nomParse;
        $this->categorie = $categorie;
        $this->stats = new StatsEquipe();
    }

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
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param string $logo
     * @return Equipe
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
        return $this;
    }

    /**
     * @return string
     */
    public function getNomParse()
    {
        return $this->nomParse;
    }

    /**
     * @param string $nomParse
     * @return Equipe
     */
    public function setNomParse($nomParse)
    {
        $this->nomParse = $nomParse;
        return $this;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return Equipe
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getDivision()
    {
        return $this->division;
    }

    /**
     * @param string $division
     * @return Equipe
     */
    public function setDivision($division)
    {
        $this->division = $division;
        return $this;
    }

    /**
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param string $categorie
     * @return Equipe
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
        return $this;
    }

    /**
     * @return StatsEquipe
     */
    public function getStats()
    {
        return $this->stats;
    }

    /**
     * @param mixed $stats
     * @return Equipe
     */
    public function setStats($stats)
    {
        $this->stats = $stats;
        return $this;
    }

    public function __toString()
    {
        return $this->nomParse . ' ' . $this->categorie;
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
     * @return Equipe
     */
    public function setClub($club)
    {
        $this->club = $club;
        return $this;
    }
}