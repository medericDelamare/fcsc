<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class EntrainementCalendrier
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 */
class EntrainementCalendrier
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
    private $titre;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=false)
     */
    private $jour;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $heureDepart;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $heureFin;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $couleur;

    /**
     * @var Stade
     * @ORM\ManyToOne("AppBundle\Entity\Stade")
     * @ORM\JoinColumn(nullable=false)
     */
    private $stade;

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
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     * @return EntrainementCalendrier
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
        return $this;
    }

    /**
     * @return int
     */
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * @param int $jour
     * @return EntrainementCalendrier
     */
    public function setJour($jour)
    {
        $this->jour = $jour;
        return $this;
    }

    /**
     * @return string
     */
    public function getHeureDepart()
    {
        return $this->heureDepart;
    }

    /**
     * @param string $heureDepart
     * @return EntrainementCalendrier
     */
    public function setHeureDepart($heureDepart)
    {
        $this->heureDepart = $heureDepart;
        return $this;
    }

    /**
     * @return string
     */
    public function getHeureFin()
    {
        return $this->heureFin;
    }

    /**
     * @param string $heureFin
     * @return EntrainementCalendrier
     */
    public function setHeureFin($heureFin)
    {
        $this->heureFin = $heureFin;
        return $this;
    }

    /**
     * @return string
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * @param string $couleur
     * @return EntrainementCalendrier
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;
        return $this;
    }

    /**
     * @return Stade
     */
    public function getStade()
    {
        return $this->stade;
    }

    /**
     * @param Stade $stade
     * @return EntrainementCalendrier
     */
    public function setStade($stade)
    {
        $this->stade = $stade;
        return $this;
    }
}