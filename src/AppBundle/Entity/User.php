<?php

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $firstName;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $lastName;

    /**
     * @var ArrayCollection
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ClubFifa")
     */
    private $clubFifa;

    public function __construct()
    {
        parent::__construct();
        $this->clubFifa = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ArrayCollection
     */
    public function getClubFifa()
    {
        return $this->clubFifa;
    }

    /**
     * @param ArrayCollection $clubFifa
     * @return User
     */
    public function setClubFifa($clubFifa)
    {
        $this->clubFifa = $clubFifa;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }
}