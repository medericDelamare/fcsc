<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Post
 *
 * @ORM\Entity()
 *
 */
class Produit
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
     * @ORM\Column(type="string", nullable=false)
     */
    private $reference;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $nomNike;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $nom;

    /**
     * @ORM\Column(type="float", scale=2)
     */
    private $prix;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $photo;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $logoObligatoire;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $logo;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $initiales;

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
     * @return Produit
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param mixed $prix
     * @return Produit
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     * @return Produit
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * @return bool
     */
    public function isLogoObligatoire()
    {
        return $this->logoObligatoire;
    }

    /**
     * @param bool $logoObligatoire
     * @return Produit
     */
    public function setLogoObligatoire($logoObligatoire)
    {
        $this->logoObligatoire = $logoObligatoire;
        return $this;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     * @return Produit
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @return string
     */
    public function getNomNike()
    {
        return $this->nomNike;
    }

    /**
     * @param string $nomNike
     * @return Produit
     */
    public function setNomNike($nomNike)
    {
        $this->nomNike = $nomNike;
        return $this;
    }

    /**
     * @return bool
     */
    public function isLogo()
    {
        return $this->logo;
    }

    /**
     * @param bool $logo
     * @return Produit
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
        return $this;
    }

    /**
     * @return bool
     */
    public function isInitiales()
    {
        return $this->initiales;
    }

    /**
     * @param bool $initiales
     * @return Produit
     */
    public function setInitiales($initiales)
    {
        $this->initiales = $initiales;
        return $this;
    }

    public function __toString()
    {
        return $this->getNom() ? $this->getNom() . ' - ' . $this->getReference() : 'produit';
    }
}