<?php


namespace AppBundle\Model\Scorenco;


class Classement
{
    private $competitionId;
    private $date;
    private $official;
    private $sportId;
    private $teams;

    /**
     * @return mixed
     */
    public function getCompetitionId()
    {
        return $this->competitionId;
    }

    /**
     * @param mixed $competitionId
     * @return Classement
     */
    public function setCompetitionId($competitionId)
    {
        $this->competitionId = $competitionId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     * @return Classement
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOfficial()
    {
        return $this->official;
    }

    /**
     * @param mixed $official
     * @return Classement
     */
    public function setOfficial($official)
    {
        $this->official = $official;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSportId()
    {
        return $this->sportId;
    }

    /**
     * @param mixed $sportId
     * @return Classement
     */
    public function setSportId($sportId)
    {
        $this->sportId = $sportId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * @param mixed $teams
     * @return Classement
     */
    public function setTeams($teams)
    {
        $this->teams = $teams;
        return $this;
    }
}