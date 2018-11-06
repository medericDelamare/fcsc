<?php


namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Xmon\ColorPickerTypeBundle\Validator\Constraints as XmonAssertColor;
/**
 * Class Club
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class Club
{
    const SERVER_PATH_TO_IMAGE_FOLDER =  '/../../../web/pictures/Logos';

    /**
     * Unmapped property to handle file uploads
     */
    private $file;

    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false, unique=true)
     */
    private $nom;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $logo;

    /**
     * @var NomParse[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\NomParse", mappedBy="club")
     */
    private $nomsParse;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @XmonAssertColor\HexColor()
     */
    private $couleurPrincipale;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $couleurSecondaire;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated;

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
     * @return Club
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param string $logo
     * @return Club
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
        return $this;
    }

    /**
     * @return NomParse[]
     */
    public function getNomsParse()
    {
        return $this->nomsParse;
    }

    /**
     * @param NomParse[] $nomsParse
     * @return Club
     */
    public function setNomsParse($nomsParse)
    {
        $this->nomsParse = $nomsParse;
        return $this;
    }

    /**
     * @return string
     */
    public function getCouleurPrincipale()
    {
        return $this->couleurPrincipale;
    }

    /**
     * @param string $couleurPrincipale
     * @return Club
     */
    public function setCouleurPrincipale($couleurPrincipale)
    {
        $this->couleurPrincipale = $couleurPrincipale;
        return $this;
    }

    /**
     * @return string
     */
    public function getCouleurSecondaire()
    {
        return $this->couleurSecondaire;
    }

    /**
     * @param string $couleurSecondaire
     * @return Club
     */
    public function setCouleurSecondaire($couleurSecondaire)
    {
        $this->couleurSecondaire = $couleurSecondaire;
        return $this;
    }

    public function __toString()
    {
        return $this->getNom() ? $this->getNom() : '';
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param \DateTime $updated
     * @return Club
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

    /**
     * Manages the copying of the file to the relevant place on the server
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        $this->getFile()->move(
            __DIR__ . self::SERVER_PATH_TO_IMAGE_FOLDER,
            $this->getFile()->getClientOriginalName()
        );

        $this->logo = $this->getFile()->getClientOriginalName();
        $this->setFile(null);
    }

    /**
     * Lifecycle callback to upload the file to the server
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function lifecycleFileUpload()
    {
        $this->upload();
    }

    /**
     * Updates the hash value to force the preUpdate and postUpdate events to fire
     */
    public function refreshUpdated()
    {
        $this->setUpdated(new \DateTime());
    }

}