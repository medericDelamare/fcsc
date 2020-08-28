<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Class
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NombreLicenciesParAnneesRepository")
 *
 */
class NombreLicenciesParAnnee
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=false, unique=true)
     */
    private $anneeDepart;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=false, unique=true)
     */
    private $anneeFin;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=false, unique=true)
     */
    private $nombreLicencies;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getAnneeDepart()
    {
        return $this->anneeDepart;
    }

    /**
     * @param int $anneeDepart
     * @return NombreLicenciesParAnnee
     */
    public function setAnneeDepart($anneeDepart)
    {
        $this->anneeDepart = $anneeDepart;
        return $this;
    }

    /**
     * @return int
     */
    public function getAnneeFin()
    {
        return $this->anneeFin;
    }

    /**
     * @param int $anneeFin
     * @return NombreLicenciesParAnnee
     */
    public function setAnneeFin($anneeFin)
    {
        $this->anneeFin = $anneeFin;
        return $this;
    }

    /**
     * @return int
     */
    public function getNombreLicencies()
    {
        return $this->nombreLicencies;
    }

    /**
     * @param int $nombreLicencies
     * @return NombreLicenciesParAnnee
     */
    public function setNombreLicencies($nombreLicencies)
    {
        $this->nombreLicencies = $nombreLicencies;
        return $this;
    }
}