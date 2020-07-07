<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Stade
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 */
class Stade
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
     * @ORM\Column(type="string", nullable=true)
     */
    private $rue;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $codePostal;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $ville;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $type;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $natureSol;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $scriptGoogle;

    /**
     * @var string
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $publie;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $textInformatif;

    /**
     * @param int $id
     * @return Stade
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
     * @return Stade
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * @param string $rue
     * @return Stade
     */
    public function setRue($rue)
    {
        $this->rue = $rue;
        return $this;
    }

    /**
     * @return string
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * @param string $codePostal
     * @return Stade
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
        return $this;
    }

    /**
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param string $ville
     * @return Stade
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
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
     * @return Stade
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getNatureSol()
    {
        return $this->natureSol;
    }

    /**
     * @param string $natureSol
     * @return Stade
     */
    public function setNatureSol($natureSol)
    {
        $this->natureSol = $natureSol;
        return $this;
    }

    /**
     * @return string
     */
    public function getScriptGoogle()
    {
        return $this->scriptGoogle;
    }

    /**
     * @param string $scriptGoogle
     * @return Stade
     */
    public function setScriptGoogle($scriptGoogle)
    {
        $this->scriptGoogle = $scriptGoogle;
        return $this;
    }

    /**
     * @return string
     */
    public function getPublie()
    {
        return $this->publie;
    }

    /**
     * @param string $publie
     * @return Stade
     */
    public function setPublie($publie)
    {
        $this->publie = $publie;
        return $this;
    }

    /**
     * @return string
     */
    public function getTextInformatif()
    {
        return $this->textInformatif;
    }

    /**
     * @param string $textInformatif
     * @return Stade
     */
    public function setTextInformatif($textInformatif)
    {
        $this->textInformatif = $textInformatif;
        return $this;
    }

    public function __toString()
    {
        return $this->getNom();
    }
}