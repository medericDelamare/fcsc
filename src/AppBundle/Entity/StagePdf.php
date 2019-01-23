<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class StagePdf
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class StagePdf
{
    const SERVER_PATH_TO_IMAGE_FOLDER =  '/../../../web/documents/Stages';

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
    private $nom;

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
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     * @return StagePdf
     */
    public function setFile($file)
    {
        $this->file = $file;
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
     * @return StagePdf
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
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
     * @return StagePdf
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

        $this->nom = $this->getFile()->getClientOriginalName();
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
    public function deletePicture(){
        if (file_exists(__DIR__ . self::SERVER_PATH_TO_IMAGE_FOLDER .'/' . $this->getNom())){
            unlink(__DIR__ . self::SERVER_PATH_TO_IMAGE_FOLDER .'/' . $this->getNom());
        }
    }
}