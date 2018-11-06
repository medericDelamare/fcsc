<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class But
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 */
class But
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var StatsRencontre
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\StatsRencontre", inversedBy="buts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $statsRencontres;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $buteur;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     * @ORM\JoinColumn(nullable=true)
     */
    private $passeur;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $penalty;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return StatsRencontre
     */
    public function getStatsRencontres()
    {
        return $this->statsRencontres;
    }

    /**
     * @param StatsRencontre $statsRencontres
     * @return But
     */
    public function setStatsRencontres($statsRencontres)
    {
        $this->statsRencontres = $statsRencontres;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getButeur()
    {
        return $this->buteur;
    }

    /**
     * @param Licencie $buteur
     * @return But
     */
    public function setButeur($buteur)
    {
        $this->buteur = $buteur;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getPasseur()
    {
        return $this->passeur;
    }

    /**
     * @param Licencie $passeur
     * @return But
     */
    public function setPasseur($passeur)
    {
        $this->passeur = $passeur;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPenalty()
    {
        return $this->penalty;
    }

    /**
     * @param bool $penalty
     * @return But
     */
    public function setPenalty($penalty)
    {
        $this->penalty = $penalty;
        return $this;
    }
}