<?php


namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/**
 * Class Categorie
 *
 * @ORM\Entity()
 *
 */
class Categorie
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
     * @ORM\Column(type="string", nullable=false, unique=true, )
     */
    private $nom;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $role;

    /**
     * @var SousCategorie[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SousCategorie", mappedBy="categorie")
     */
    private $sousCategories;

    public function __construct()
    {
        $this->sousCategories = new ArrayCollection();
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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return Categorie
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $role
     * @return Categorie
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return SousCategorie[]
     */
    public function getSousCategories()
    {
        return $this->sousCategories;
    }

    /**
     * @param SousCategorie[] $sousCategories
     * @return Categorie
     */
    public function setSousCategories($sousCategories)
    {
        $this->sousCategories = $sousCategories;
        return $this;
    }



    public function __toString()
    {
        return $this->getNom() ? $this->getNom() : 'Categorie';
    }
}