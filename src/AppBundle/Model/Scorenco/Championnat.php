<?php


namespace AppBundle\Model\Scorenco;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Championnat
 */
class Championnat
{
    private $id;
    private $name;
    private $category;
    private $levelSlug;
    private $poolSlug;
    private $levelName;
    private $phaseAndPoolName;
    private $rounds;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Championnat
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
     * @return Championnat
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     * @return Championnat
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLevelSlug()
    {
        return $this->levelSlug;
    }

    /**
     * @param mixed $levelSlug
     * @return Championnat
     */
    public function setLevelSlug($levelSlug)
    {
        $this->levelSlug = $levelSlug;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPoolSlug()
    {
        return $this->poolSlug;
    }

    /**
     * @param mixed $poolSlug
     * @return Championnat
     */
    public function setPoolSlug($poolSlug)
    {
        $this->poolSlug = $poolSlug;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLevelName()
    {
        return $this->levelName;
    }

    /**
     * @param mixed $levelName
     * @return Championnat
     */
    public function setLevelName($levelName)
    {
        $this->levelName = $levelName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhaseAndPoolName()
    {
        return $this->phaseAndPoolName;
    }

    /**
     * @param mixed $phaseAndPoolName
     * @return Championnat
     */
    public function setPhaseAndPoolName($phaseAndPoolName)
    {
        $this->phaseAndPoolName = $phaseAndPoolName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRounds()
    {
        return $this->rounds;
    }

    /**
     * @param mixed $rounds
     * @return Championnat
     */
    public function setRounds($rounds)
    {
        $this->rounds = $rounds;
        return $this;
    }
}