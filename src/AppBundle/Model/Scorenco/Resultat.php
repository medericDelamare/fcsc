<?php


namespace AppBundle\Model\Scorenco;


class Resultat
{
    private $id;
    private $status;
    private $gameStatus;
    private $date;
    private $url;
    private $sportId;
    private $timeUnavailable;
    private $isLive;
    private $competitionId;
    private $teams;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Resultat
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return Resultat
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGameStatus()
    {
        return $this->gameStatus;
    }

    /**
     * @param mixed $gameStatus
     * @return Resultat
     */
    public function setGameStatus($gameStatus)
    {
        $this->gameStatus = $gameStatus;
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
     * @return Resultat
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     * @return Resultat
     */
    public function setUrl($url)
    {
        $this->url = $url;
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
     * @return Resultat
     */
    public function setSportId($sportId)
    {
        $this->sportId = $sportId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTimeUnavailable()
    {
        return $this->timeUnavailable;
    }

    /**
     * @param mixed $timeUnavailable
     * @return Resultat
     */
    public function setTimeUnavailable($timeUnavailable)
    {
        $this->timeUnavailable = $timeUnavailable;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getisLive()
    {
        return $this->isLive;
    }

    /**
     * @param mixed $isLive
     * @return Resultat
     */
    public function setIsLive($isLive)
    {
        $this->isLive = $isLive;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCompetitionId()
    {
        return $this->competitionId;
    }

    /**
     * @param mixed $competitionId
     * @return Resultat
     */
    public function setCompetitionId($competitionId)
    {
        $this->competitionId = $competitionId;
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
     * @return Resultat
     */
    public function setTeams($teams)
    {
        $this->teams = $teams;
        return $this;
    }
}