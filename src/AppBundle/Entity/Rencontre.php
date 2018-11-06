<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Rencontre
 * @package AppBundle\Entity
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RencontreRepository")
 */
class Rencontre
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
    private $equipeDomicile;

    /**
     * @var Equipe
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Equipe")
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipeExterieure;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    private $journee;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $arbitre;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $terrain;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $score;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $surfaceDeJeu;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\StatsRencontre", mappedBy="rencontre")
     */
    private $stats;

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
    public function getEquipeDomicile()
    {
        return $this->equipeDomicile;
    }

    /**
     * @param Equipe $equipeDomicile
     * @return Rencontre
     */
    public function setEquipeDomicile($equipeDomicile)
    {
        $this->equipeDomicile = $equipeDomicile;
        return $this;
    }

    /**
     * @return Equipe
     */
    public function getEquipeExterieure()
    {
        return $this->equipeExterieure;
    }

    /**
     * @param Equipe $equipeExterieure
     * @return Rencontre
     */
    public function setEquipeExterieure($equipeExterieure)
    {
        $this->equipeExterieure = $equipeExterieure;
        return $this;
    }

    /**
     * @return int
     */
    public function getJournee()
    {
        return $this->journee;
    }

    /**
     * @param int $journee
     * @return Rencontre
     */
    public function setJournee($journee)
    {
        $this->journee = $journee;
        return $this;
    }

    /**
     * @return string
     */
    public function getArbitre()
    {
        return $this->arbitre;
    }

    /**
     * @param string $arbitre
     * @return Rencontre
     */
    public function setArbitre($arbitre)
    {
        $this->arbitre = $arbitre;
        return $this;
    }

    /**
     * @return string
     */
    public function getTerrain()
    {
        return $this->terrain;
    }

    /**
     * @param string $terrain
     * @return Rencontre
     */
    public function setTerrain($terrain)
    {
        $this->terrain = $terrain;
        return $this;
    }

    /**
     * @return string
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param string $score
     * @return Rencontre
     */
    public function setScore($score)
    {
        $this->score = $score;
        return $this;
    }

    /**
     * @return string
     */
    public function getSurfaceDeJeu()
    {
        return $this->surfaceDeJeu;
    }

    /**
     * @param string $surfaceDeJeu
     * @return Rencontre
     */
    public function setSurfaceDeJeu($surfaceDeJeu)
    {
        $this->surfaceDeJeu = $surfaceDeJeu;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return Rencontre
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStats()
    {
        return $this->stats;
    }

    /**
     * @param mixed $stats
     * @return Rencontre
     */
    public function setStats($stats)
    {
        $this->stats = $stats;
        return $this;
    }

    public function __toString()
    {
        if ($this->getEquipeDomicile()){
            $categoryFormat = ucfirst($this->getEquipeDomicile()->getCategorie());
            $categoryFormat = preg_replace('/(?=(?<!^)[[:upper:]])/', ' ', $categoryFormat);
            $rencontre = $this->getEquipeDomicile()->getNomParse() . ' - ' . $this->getEquipeExterieure()->getNomParse() . ' ( ' . $categoryFormat . ' )';
        }else{
            $rencontre = 'rencontre';
        }

        return $rencontre;
    }
}