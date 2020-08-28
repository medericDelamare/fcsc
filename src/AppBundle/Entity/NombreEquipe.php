<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Class NombreEquipe
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NombreEquipeRepository")
 *
 */
class NombreEquipe
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
     * @var integer
     * @ORM\Column(type="integer", nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=false)
     */
    private $ordre;

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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return NombreEquipe
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return int
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param int $nombre
     * @return NombreEquipe
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return int
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * @param int $ordre
     * @return NombreEquipe
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;
        return $this;
    }
}