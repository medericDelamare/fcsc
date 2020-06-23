<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Class Option
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class MotPresident
{
    const SERVER_PATH_TO_IMAGE_FOLDER =  '/../../../web/pictures/President';

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
     * Unmapped property to handle file uploads
     */
    private $file;


    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $nomImage;

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
    public function getMotDuPresident()
    {
        return $this->motDuPresident;
    }

    /**
     * @param string $motDuPresident
     * @return MotPresident
     */
    public function setMotDuPresident($motDuPresident)
    {
        $this->motDuPresident = $motDuPresident;
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
     * @return MotPresident
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return string
     */
    public function getNomImage()
    {
        return $this->nomImage;
    }

    /**
     * @param string $nomImage
     * @return MotPresident
     */
    public function setNomImage($nomImage)
    {
        $this->nomImage = $nomImage;
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
     * @return MotPresident
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

        $this->nomImage = $this->getFile()->getClientOriginalName();
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
        if (file_exists(__DIR__ . self::SERVER_PATH_TO_IMAGE_FOLDER .'/' . $this->getNomImage())){
            unlink(__DIR__ . self::SERVER_PATH_TO_IMAGE_FOLDER .'/' . $this->getNomImage());
        }
    }
}