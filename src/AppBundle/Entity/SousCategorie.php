<?php


namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
/**
 * Class SousCategorie
 *
 * @ORM\Entity()
 *
 */
class SousCategorie
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
     * @var Categorie
     * @ORM\ManyToOne(targetEntity="Categorie", inversedBy="sousCategories")
     * @ORM\JoinColumn(nullable=true)
     */
    private $categorie;

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
     * @return SousCategorie
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param Categorie $categorie
     * @return SousCategorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
        return $this;
    }
}