<?php


namespace AppBundle\Entity;

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

    public function __toString()
    {
        return $this->getNom() ? $this->getNom() : 'Categorie';
    }
}