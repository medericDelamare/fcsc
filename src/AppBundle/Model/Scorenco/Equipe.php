<?php

namespace AppBundle\Model\Scorenco;


class Equipe
{
    private $teamId;
    private $clubId;
    private $teamSlug;
    private $clubSlug;
    private $name;
    private $score;
    private $result;
    private $data;
    private $rankingData;
    private $rank;
    private $lastResults;

    /**
     * @return mixed
     */
    public function getTeamId()
    {
        return $this->teamId;
    }

    /**
     * @param mixed $teamId
     * @return Equipe
     */
    public function setTeamId($teamId)
    {
        $this->teamId = $teamId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClubId()
    {
        return $this->clubId;
    }

    /**
     * @param mixed $clubId
     * @return Equipe
     */
    public function setClubId($clubId)
    {
        $this->clubId = $clubId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTeamSlug()
    {
        return $this->teamSlug;
    }

    /**
     * @param mixed $teamSlug
     * @return Equipe
     */
    public function setTeamSlug($teamSlug)
    {
        $this->teamSlug = $teamSlug;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClubSlug()
    {
        return $this->clubSlug;
    }

    /**
     * @param mixed $clubSlug
     * @return Equipe
     */
    public function setClubSlug($clubSlug)
    {
        $this->clubSlug = $clubSlug;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Equipe
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param mixed $score
     * @return Equipe
     */
    public function setScore($score)
    {
        $this->score = $score;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param mixed $result
     * @return Equipe
     */
    public function setResult($result)
    {
        $this->result = $result;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     * @return Equipe
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRankingData()
    {
        return $this->rankingData;
    }

    /**
     * @param mixed $rankingData
     * @return Equipe
     */
    public function setRankingData($rankingData)
    {
        $this->rankingData = $rankingData;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * @param mixed $rank
     * @return Equipe
     */
    public function setRank($rank)
    {
        $this->rank = $rank;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastResults()
    {
        return $this->lastResults;
    }

    /**
     * @param mixed $lastResults
     * @return Equipe
     */
    public function setLastResults($lastResults)
    {
        $this->lastResults = $lastResults;
        return $this;
    }
}