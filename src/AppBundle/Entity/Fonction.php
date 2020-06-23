<?php


namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Licencié
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FonctionRepository")
 *
 */
class Fonction
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
     * @ORM\Column(type="string", nullable=false)
     */
    private $nom;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $code;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Licencie", inversedBy="fonctions")
     * @ORM\JoinTable(name="licencies_fonctions")
     */
    private $licencies;

    /**
     * Fonction constructor.
     */
    public function __construct()
    {
        $this->licencies = new ArrayCollection();
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Fonction
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return Fonction
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return Fonction
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Fonction
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLicencies()
    {
        return $this->licencies;
    }

    /**
     * @param mixed $licencies
     * @return Fonction
     */
    public function setLicencies($licencies)
    {
        $this->licencies = $licencies;
        return $this;
    }

    public function addLicencie(Licencie $licencie){
        $this->licencies->add($this->licencies);
        $licencie->setFonctions($this);
        return $this;
    }



}