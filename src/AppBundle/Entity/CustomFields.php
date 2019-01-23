<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Class Option
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 */
class CustomFields
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=false)
     */
    private $motDuPresident;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getMotDuPresident()
    {
        return $this->motDuPresident;
    }

    /**
     * @param string $motDuPresident
     * @return CustomFields
     */
    public function setMotDuPresident($motDuPresident)
    {
        $this->motDuPresident = $motDuPresident;
        return $this;
    }
}