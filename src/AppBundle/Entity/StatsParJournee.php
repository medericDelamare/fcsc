<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Class StatsParJournee
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StatsParJourneeRepository")
 *
 */
class StatsParJournee
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Equipe
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Equipe")
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipe;

    /**
     * @var string
     * @ORM\Column(type="integer")
     */
    private $journee;

    /**
     * @var string
     * @ORM\Column(type="integer")
     */
    private $place;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Equipe
     */
    public function getEquipe()
    {
        return $this->equipe;
    }

    /**
     * @param Equipe $equipe
     * @return StatsParJournee
     */
    public function setEquipe($equipe)
    {
        $this->equipe = $equipe;
        return $this;
    }

    /**
     * @return string
     */
    public function getJournee()
    {
        return $this->journee;
    }

    /**
     * @param string $journee
     * @return StatsParJournee
     */
    public function setJournee($journee)
    {
        $this->journee = $journee;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @param string $place
     * @return StatsParJournee
     */
    public function setPlace($place)
    {
        $this->place = $place;
        return $this;
    }
}