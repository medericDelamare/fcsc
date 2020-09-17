<?php


namespace AppBundle\Model\Scorenco;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Journee
 */
class Journee
{
    private $id;
    private $name;
    private $code;
    private $rank;
    private $officialDate;
    private $events;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Journee
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return Journee
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     * @return Journee
     */
    public function setCode($code)
    {
        $this->code = $code;
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
     * @return Journee
     */
    public function setRank($rank)
    {
        $this->rank = $rank;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOfficialDate()
    {
        return $this->officialDate;
    }

    /**
     * @param mixed $officialDate
     * @return Journee
     */
    public function setOfficialDate($officialDate)
    {
        $this->officialDate = $officialDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param mixed $events
     * @return Journee
     */
    public function setEvents($events)
    {
        $this->events = $events;
        return $this;
    }
}