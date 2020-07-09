<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Secretariat
 * @package AppBundle\Entity
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SecretariatRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Secretariat
{
    const SERVER_PATH_TO_IMAGE_FOLDER = '/../../../web/pictures/Secretariat';
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
    private $texte;

    /**
     * Unmapped property to handle file uploads
     */
    private $file;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $image;

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
     * @return Secretariat
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
        return $this;
    }

    /**
     * @return string
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * @param string $texte
     * @return Secretariat
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     * @return Secretariat
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return Secretariat
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
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
     * @return Secretariat
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

        $this->image = $this->getFile()->getClientOriginalName();
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

    /**
     * @ORM\PostRemove()
     */
    public function deletePicture()
    {
        if (file_exists(__DIR__ . self::SERVER_PATH_TO_IMAGE_FOLDER . '/' . $this->getImage())) {
            unlink(__DIR__ . self::SERVER_PATH_TO_IMAGE_FOLDER . '/' . $this->getImage());
        }
    }
}