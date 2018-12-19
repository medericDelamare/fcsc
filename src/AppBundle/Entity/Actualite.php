<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class Actualite
 * @package AppBundle\Entity
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ActualiteRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Actualite
{
    const SERVER_PATH_TO_IMAGE_FOLDER =  '/../../../web/pictures/Actualites';

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
     * @ORM\Column(type="string", nullable=false)
     */
    private $titre;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=false)
     */
    private $contenu;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $publie;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $photo;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=false)
     */
    private $position;


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
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     * @return Actualite
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
        return $this;
    }

    /**
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param string $contenu
     * @return Actualite
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPublie()
    {
        return $this->publie;
    }

    /**
     * @param bool $publie
     * @return Actualite
     */
    public function setPublie($publie)
    {
        $this->publie = $publie;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     * @return Actualite
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     * @return Actualite
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
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
     * @return Actualite
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

        $this->photo = $this->getFile()->getClientOriginalName();
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