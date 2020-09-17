<?php


namespace AppBundle\Model\Scorenco;


class ResultRequest
{
    private $count;
    private $next;
    private $previous;
    private $results;

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param mixed $count
     * @return ResultRequest
     */
    public function setCount($count)
    {
        $this->count = $count;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNext()
    {
        return $this->next;
    }

    /**
     * @param mixed $next
     * @return ResultRequest
     */
    public function setNext($next)
    {
        $this->next = $next;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrevious()
    {
        return $this->previous;
    }

    /**
     * @param mixed $previous
     * @return ResultRequest
     */
    public function setPrevious($previous)
    {
        $this->previous = $previous;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param mixed $results
     * @return ResultRequest
     */
    public function setResults($results)
    {
        $this->results = $results;
        return $this;
    }
}