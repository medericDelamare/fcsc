<?php


namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class StatsJoueur
 *
 * @ORM\Entity()
 *
 */

class StatsJoueur
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     * @ORM\Column(type="integer",nullable=true)
     */
    private $butsA = 0;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=true)
     */
    private $butsB = 0;

    /**
     * @var integer
     * @ORM\Column(type="integer",nullable=true)
     */
    private $butsCoupe = 0;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=true)
     */
    private $buts = 0;

    /**
     * @var integer
     * @ORM\Column(type="integer",nullable=true)
     */
    private $cartonsJaunes = 0;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cartonsRouges = 0;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Poste")
     * @ORM\JoinColumn(nullable=true)
     */
    private $poste;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=true)
     */
    private $passes = 0;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbMatchs = 0;

    /**
     * @var Licencie
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Licencie", mappedBy="stats")
     */
    private $licencie;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getButsA()
    {
        return $this->butsA;
    }

    /**
     * @param int $butsA
     * @return StatsJoueur
     */
    public function setButsA($butsA)
    {
        $this->butsA = $butsA;
        return $this;
    }

    /**
     * @return int
     */
    public function getButsB()
    {
        return $this->butsB;
    }

    /**
     * @param int $butsB
     * @return StatsJoueur
     */
    public function setButsB($butsB)
    {
        $this->butsB = $butsB;
        return $this;
    }

    /**
     * @return int
     */
    public function getButsCoupe()
    {
        return $this->butsCoupe;
    }

    /**
     * @param int $butsCoupe
     * @return StatsJoueur
     */
    public function setButsCoupe($butsCoupe)
    {
        $this->butsCoupe = $butsCoupe;
        return $this;
    }

    /**
     * @return int
     */
    public function getButs()
    {
        return $this->buts;
    }

    /**
     * @param int $buts
     * @return StatsJoueur
     */
    public function setButs($buts)
    {
        $this->buts = $buts;
        return $this;
    }

    /**
     * @return int
     */
    public function getCartonsJaunes()
    {
        return $this->cartonsJaunes;
    }

    /**
     * @param int $cartonsJaunes
     * @return StatsJoueur
     */
    public function setCartonsJaunes($cartonsJaunes)
    {
        $this->cartonsJaunes = $cartonsJaunes;
        return $this;
    }

    /**
     * @return int
     */
    public function getCartonsRouges()
    {
        return $this->cartonsRouges;
    }

    /**
     * @param int $cartonsRouges
     * @return StatsJoueur
     */
    public function setCartonsRouges($cartonsRouges)
    {
        $this->cartonsRouges = $cartonsRouges;
        return $this;
    }

    /**
     * @return string
     */
    public function getPoste()
    {
        return $this->poste;
    }

    /**
     * @param string $poste
     * @return StatsJoueur
     */
    public function setPoste($poste)
    {
        $this->poste = $poste;
        return $this;
    }

    /**
     * @return int
     */
    public function getPasses()
    {
        return $this->passes;
    }

    /**
     * @param int $passes
     * @return StatsJoueur
     */
    public function setPasses($passes)
    {
        $this->passes = $passes;
        return $this;
    }

    /**
     * @return int
     */
    public function getNbMatchs()
    {
        return $this->nbMatchs;
    }

    /**
     * @param int $nbMatchs
     * @return StatsJoueur
     */
    public function setNbMatchs($nbMatchs)
    {
        $this->nbMatchs = $nbMatchs;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getLicencie()
    {
        return $this->licencie;
    }

    /**
     * @param Licencie $licencie
     * @return StatsJoueur
     */
    public function setLicencie($licencie)
    {
        $this->licencie = $licencie;
        return $this;
    }

    public function incrementButA(){
        $this->butsA = $this->butsA + 1;
    }

    public function incrementButB(){
        $this->butsB = $this->butsB + 1;
    }

    public function incrementButCoupe(){
        $this->butsCoupe = $this->butsCoupe + 1;
    }
}