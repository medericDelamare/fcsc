<?php

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class NomParse
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 */
class NomParse
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
     * @ORM\Column(type="string", nullable=false, unique=true)
     */
    private $nom;

    /**
     * @var Club
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Club", inversedBy="nomsParse")
     * @ORM\JoinColumn(nullable=false)
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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return NomParse
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
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
     * @return NomParse
     */
    public function setClub($club)
    {
        $this->club = $club;
        return $this;
    }
}