<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Embeddable */
class StatsEquipe
{
    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    private $points = 0;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    private $journees = 0;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    private $victoires = 0;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nuls = 0;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    private $defaites = 0;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    private $forfaits = 0;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    private $butsPour = 0;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    private $butsContre = 0;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    private $penalites = 0;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    private $difference = 0;

    /**
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param int $points
     * @return StatsEquipe
     */
    public function setPoints($points)
    {
        $this->points = $points;
        return $this;
    }

    public function addPoints($points){
        $this->points = $this->points + $points;
        return $this;
    }

    /**
     * @return int
     */
    public function getJournees()
    {
        return $this->journees;
    }

    /**
     * @param int $journees
     * @return StatsEquipe
     */
    public function setJournees($journees)
    {
        $this->journees = $journees;
        return $this;
    }

    public function addJournee(){
        $this->journees = $this->journees + 1;
        return $this;
    }

    /**
     * @return int
     */
    public function getVictoires()
    {
        return $this->victoires;
    }

    /**
     * @param int $victoires
     * @return StatsEquipe
     */
    public function setVictoires($victoires)
    {
        $this->victoires = $victoires;
        return $this;
    }

    public function addVictoire(){
        $this->victoires = $this->victoires + 1;
        return $this;
    }

    /**
     * @return int
     */
    public function getNuls()
    {
        return $this->nuls;
    }

    /**
     * @param int $nuls
     * @return StatsEquipe
     */
    public function setNuls($nuls)
    {
        $this->nuls = $nuls;
        return $this;
    }

    public function addNul(){
        $this->nuls = $this->nuls + 1;
        return $this;
    }

    /**
     * @return int
     */
    public function getDefaites()
    {
        return $this->defaites;
    }

    /**
     * @param int $defaites
     * @return StatsEquipe
     */
    public function setDefaites($defaites)
    {
        $this->defaites = $defaites;
        return $this;
    }

    public function addDefaite(){
        $this->defaites = $this->defaites + 1;
        return $this;
    }

    /**
     * @return int
     */
    public function getForfaits()
    {
        return $this->forfaits;
    }

    /**
     * @param int $forfaits
     * @return StatsEquipe
     */
    public function setForfaits($forfaits)
    {
        $this->forfaits = $forfaits;
        return $this;
    }

    public function addForfait(){
        $this->forfaits = $this->forfaits + 1;
        return $this;
    }

    /**
     * @return int
     */
    public function getButsPour()
    {
        return $this->butsPour;
    }

    /**
     * @param int $butsPour
     * @return StatsEquipe
     */
    public function setButsPour($butsPour)
    {
        $this->butsPour = $butsPour;
        return $this;
    }

    public function addButsPour($buts){
        $this->butsPour = $this->butsPour + $buts;
        return $this;
    }

    /**
     * @return int
     */
    public function getButsContre()
    {
        return $this->butsContre;
    }

    /**
     * @param int $butsContre
     * @return StatsEquipe
     */
    public function setButsContre($butsContre)
    {
        $this->butsContre = $butsContre;
        return $this;
    }

    public function addButsContre($buts){
        $this->butsContre = $this->butsContre + $buts;
        return $this;
    }

    /**
     * @return int
     */
    public function getPenalites()
    {
        return $this->penalites;
    }

    /**
     * @param int $penalites
     * @return StatsEquipe
     */
    public function setPenalites($penalites)
    {
        $this->penalites = $penalites;
        return $this;
    }

    public function addPenalite(){
        $this->butsContre = $this->butsContre + 1;
        return $this;
    }

    /**
     * @return int
     */
    public function getDifference()
    {
        return $this->difference;
    }

    /**
     * @param int $difference
     * @return StatsEquipe
     */
    public function setDifference($difference)
    {
        $this->difference = $difference;
        return $this;
    }

    public function addDifference($buts){
        $this->difference = $this->difference + $buts;
        return $this;
    }

    public function computeVictoire($butsPour, $butsContre){
        $this
            ->addVictoire()
            ->addPoints(3)
            ->addJournee()
            ->addButsPour($butsPour)
            ->addButsContre($butsContre)
            ->addDifference($butsPour - $butsContre);

        return $this;
    }

    public function computeDefaite($butsPour, $butsContre){
        $this
            ->addDefaite()
            ->addPoints(0)
            ->addJournee()
            ->addButsPour($butsPour)
            ->addButsContre($butsContre)
            ->addDifference($butsPour - $butsContre);

        return $this;
    }

    public function computeForfaitPour(){
        $this
            ->addVictoire()
            ->addPoints(3)
            ->addJournee()
            ->addButsPour(5)
            ->addButsContre(0)
            ->addDifference(5);

        return $this;
    }

    public function computeForfaitContre(){
        $this
            ->addDefaite()
            ->addPoints(-1)
            ->addJournee()
            ->addForfait()
            ->addButsPour(0)
            ->addButsContre(5)
            ->addDifference(-5);

        return $this;
    }

    public function computeNul($butsPour, $butsContre){
        $this
            ->addNul()
            ->addPoints(1)
            ->addJournee()
            ->addButsPour($butsPour)
            ->addButsContre($butsContre);
    }

    public function computeForfaitGeneral(){
        $this
            ->setButsContre(0)
            ->setButsPour(0)
            ->setDefaites(0)
            ->setDifference(0)
            ->setForfaits(0)
            ->setJournees(0)
            ->setNuls(0)
            ->setPenalites(0)
            ->setVictoires(0)
            ->setPoints(0);
    }
}