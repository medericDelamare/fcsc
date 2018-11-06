<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Historique par année
 *
 * @ORM\Entity()
 *
 */
class HistoriqueClassement
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
    private $annee;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=false)
     */
    private $position;

    /**
     * @var string
     * @ORM\Column(type="integer", nullable=false)
     */
    private $nbPoints;

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
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * @param string $annee
     * @return HistoriqueClassement
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;
        return $this;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     * @return HistoriqueClassement
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }

    /**
     * @return string
     */
    public function getNbPoints()
    {
        return $this->nbPoints;
    }

    /**
     * @param string $nbPoints
     * @return HistoriqueClassement
     */
    public function setNbPoints($nbPoints)
    {
        $this->nbPoints = $nbPoints;
        return $this;
    }
}