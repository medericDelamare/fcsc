<?php


namespace AppBundle\Model\Scorenco;


class RankingData
{
    private $points;
    private $journees;
    private $victoires;
    private $nuls;
    private $defaites;
    private $forfaits;
    private $butsP;
    private $butsC;
    private $diff;

    /**
     * @return mixed
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param mixed $points
     * @return RankingData
     */
    public function setPoints($points)
    {
        $this->points = $points;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getJournees()
    {
        return $this->journees;
    }

    /**
     * @param mixed $journees
     * @return RankingData
     */
    public function setJournees($journees)
    {
        $this->journees = $journees;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVictoires()
    {
        return $this->victoires;
    }

    /**
     * @param mixed $victoires
     * @return RankingData
     */
    public function setVictoires($victoires)
    {
        $this->victoires = $victoires;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNuls()
    {
        return $this->nuls;
    }

    /**
     * @param mixed $nuls
     * @return RankingData
     */
    public function setNuls($nuls)
    {
        $this->nuls = $nuls;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDefaites()
    {
        return $this->defaites;
    }

    /**
     * @param mixed $defaites
     * @return RankingData
     */
    public function setDefaites($defaites)
    {
        $this->defaites = $defaites;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getForfaits()
    {
        return $this->forfaits;
    }

    /**
     * @param mixed $forfaits
     * @return RankingData
     */
    public function setForfaits($forfaits)
    {
        $this->forfaits = $forfaits;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getButsP()
    {
        return $this->butsP;
    }

    /**
     * @param mixed $butsP
     * @return RankingData
     */
    public function setButsP($butsP)
    {
        $this->butsP = $butsP;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getButsC()
    {
        return $this->butsC;
    }

    /**
     * @param mixed $butsC
     * @return RankingData
     */
    public function setButsC($butsC)
    {
        $this->butsC = $butsC;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDiff()
    {
        return $this->diff;
    }

    /**
     * @param mixed $diff
     * @return RankingData
     */
    public function setDiff($diff)
    {
        $this->diff = $diff;
        return $this;
    }
}