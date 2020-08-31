<?php


namespace AppBundle\Model\Scorenco;


class InformationsCompetition
{
    private $id;
    private $name;
    private $code;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return InformationsCompetition
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
     * @return InformationsCompetition
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
     * @return InformationsCompetition
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }
}