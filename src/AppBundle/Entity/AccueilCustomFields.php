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
class AccueilCustomFields
{
    const SERVER_PATH_TO_IMAGE_FOLDER =  '/../../../web/pictures/Accueil';

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
     * Unmapped property to handle file uploads
     */
    private $filePartenaire;


    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $nomImage;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $nomImagePartenaire;

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
     * @return AccueilCustomFields
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
     * @return AccueilCustomFields
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
     * @return AccueilCustomFields
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
     * @return AccueilCustomFields
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFilePartenaire()
    {
        return $this->filePartenaire;
    }

    /**
     * @param mixed $filePartenaire
     * @return AccueilCustomFields
     */
    public function setFilePartenaire($filePartenaire)
    {
        $this->filePartenaire = $filePartenaire;
        return $this;
    }

    /**
     * @return string
     */
    public function getNomImagePartenaire()
    {
        return $this->nomImagePartenaire;
    }

    /**
     * @param string $nomImagePartenaire
     * @return AccueilCustomFields
     */
    public function setNomImagePartenaire($nomImagePartenaire)
    {
        $this->nomImagePartenaire = $nomImagePartenaire;
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
     * Manages the copying of the file to the relevant place on the server
     */
    public function uploadPartenaires()
    {
        if (null === $this->getFilePartenaire()) {
            return;
        }

        $this->getFilePartenaire()->move(
            __DIR__ . self::SERVER_PATH_TO_IMAGE_FOLDER,
            $this->getFilePartenaire()->getClientOriginalName()
        );

        $this->nomImagePartenaire = $this->getFilePartenaire()->getClientOriginalName();
        $this->setFilePartenaire(null);
    }

    /**
     * Lifecycle callback to upload the file to the server
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function lifecycleFileUpload()
    {
        $this->upload();
        $this->uploadPartenaires();
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

        if (file_exists(__DIR__ . self::SERVER_PATH_TO_IMAGE_FOLDER .'/' . $this->getNomImagePartenaire())){
            unlink(__DIR__ . self::SERVER_PATH_TO_IMAGE_FOLDER .'/' . $this->getNomImagePartenaire());
        }
    }
}