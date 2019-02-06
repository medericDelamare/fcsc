<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Bureau
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 */

class Bureau
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $president;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $vicePresident;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $secretaire;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $tresorier;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $responsableEquipement;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $responsableSeniorA;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $responsableSeniorB;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $responsableVeterans;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $responsableCdm;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $responsableU19;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $responsableU17;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $responsableU15;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $responsableU12U13;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $responsableU11;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $responsableU10;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $responsableU6U9;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $responsablePoleFeminin;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $responsableGardiens;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $responsableEcoleDeFoot;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $membre1;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $membre2;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $membre3;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $membre4;






    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Licencie
     */
    public function getPresident()
    {
        return $this->president;
    }

    /**
     * @param Licencie $president
     * @return Bureau
     */
    public function setPresident($president)
    {
        $this->president = $president;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getVicePresident()
    {
        return $this->vicePresident;
    }

    /**
     * @param Licencie $vicePresident
     * @return Bureau
     */
    public function setVicePresident($vicePresident)
    {
        $this->vicePresident = $vicePresident;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getSecretaire()
    {
        return $this->secretaire;
    }

    /**
     * @param Licencie $secretaire
     * @return Bureau
     */
    public function setSecretaire($secretaire)
    {
        $this->secretaire = $secretaire;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getTresorier()
    {
        return $this->tresorier;
    }

    /**
     * @param Licencie $tresorier
     * @return Bureau
     */
    public function setTresorier($tresorier)
    {
        $this->tresorier = $tresorier;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getResponsableSeniorA()
    {
        return $this->responsableSeniorA;
    }

    /**
     * @param Licencie $responsableSeniorA
     * @return Bureau
     */
    public function setResponsableSeniorA($responsableSeniorA)
    {
        $this->responsableSeniorA = $responsableSeniorA;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getResponsableSeniorB()
    {
        return $this->responsableSeniorB;
    }

    /**
     * @param Licencie $responsableSeniorB
     * @return Bureau
     */
    public function setResponsableSeniorB($responsableSeniorB)
    {
        $this->responsableSeniorB = $responsableSeniorB;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getResponsableVeterans()
    {
        return $this->responsableVeterans;
    }

    /**
     * @param Licencie $responsableVeterans
     * @return Bureau
     */
    public function setResponsableVeterans($responsableVeterans)
    {
        $this->responsableVeterans = $responsableVeterans;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getResponsableCdm()
    {
        return $this->responsableCdm;
    }

    /**
     * @param Licencie $responsableCdm
     * @return Bureau
     */
    public function setResponsableCdm($responsableCdm)
    {
        $this->responsableCdm = $responsableCdm;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getResponsableU19()
    {
        return $this->responsableU19;
    }

    /**
     * @param Licencie $responsableU19
     * @return Bureau
     */
    public function setResponsableU19($responsableU19)
    {
        $this->responsableU19 = $responsableU19;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getResponsableU17()
    {
        return $this->responsableU17;
    }

    /**
     * @param Licencie $responsableU17
     * @return Bureau
     */
    public function setResponsableU17($responsableU17)
    {
        $this->responsableU17 = $responsableU17;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getResponsableU15()
    {
        return $this->responsableU15;
    }

    /**
     * @param Licencie $responsableU15
     * @return Bureau
     */
    public function setResponsableU15($responsableU15)
    {
        $this->responsableU15 = $responsableU15;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getResponsableU12U13()
    {
        return $this->responsableU12U13;
    }

    /**
     * @param Licencie $responsableU12U13
     * @return Bureau
     */
    public function setResponsableU12U13($responsableU12U13)
    {
        $this->responsableU12U13 = $responsableU12U13;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getResponsableU11()
    {
        return $this->responsableU11;
    }

    /**
     * @param Licencie $responsableU11
     * @return Bureau
     */
    public function setResponsableU11($responsableU11)
    {
        $this->responsableU11 = $responsableU11;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getResponsableU10()
    {
        return $this->responsableU10;
    }

    /**
     * @param Licencie $responsableU10
     * @return Bureau
     */
    public function setResponsableU10($responsableU10)
    {
        $this->responsableU10 = $responsableU10;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getResponsableU6U9()
    {
        return $this->responsableU6U9;
    }

    /**
     * @param Licencie $responsableU6U9
     * @return Bureau
     */
    public function setResponsableU6U9($responsableU6U9)
    {
        $this->responsableU6U9 = $responsableU6U9;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getResponsablePoleFeminin()
    {
        return $this->responsablePoleFeminin;
    }

    /**
     * @param Licencie $responsablePoleFeminin
     * @return Bureau
     */
    public function setResponsablePoleFeminin($responsablePoleFeminin)
    {
        $this->responsablePoleFeminin = $responsablePoleFeminin;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getResponsableGardiens()
    {
        return $this->responsableGardiens;
    }

    /**
     * @param Licencie $responsableGardiens
     * @return Bureau
     */
    public function setResponsableGardiens($responsableGardiens)
    {
        $this->responsableGardiens = $responsableGardiens;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getResponsableEquipement()
    {
        return $this->responsableEquipement;
    }

    /**
     * @param Licencie $responsableEquipement
     * @return Bureau
     */
    public function setResponsableEquipement($responsableEquipement)
    {
        $this->responsableEquipement = $responsableEquipement;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getMembre1()
    {
        return $this->membre1;
    }

    /**
     * @param Licencie $membre1
     * @return Bureau
     */
    public function setMembre1($membre1)
    {
        $this->membre1 = $membre1;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getMembre2()
    {
        return $this->membre2;
    }

    /**
     * @param Licencie $membre2
     * @return Bureau
     */
    public function setMembre2($membre2)
    {
        $this->membre2 = $membre2;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getMembre3()
    {
        return $this->membre3;
    }

    /**
     * @param Licencie $membre3
     * @return Bureau
     */
    public function setMembre3($membre3)
    {
        $this->membre3 = $membre3;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getMembre4()
    {
        return $this->membre4;
    }

    /**
     * @param Licencie $membre4
     * @return Bureau
     */
    public function setMembre4($membre4)
    {
        $this->membre4 = $membre4;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getResponsableEcoleDeFoot()
    {
        return $this->responsableEcoleDeFoot;
    }

    /**
     * @param Licencie $responsableEcoleDeFoot
     * @return Bureau
     */
    public function setResponsableEcoleDeFoot($responsableEcoleDeFoot)
    {
        $this->responsableEcoleDeFoot = $responsableEcoleDeFoot;
        return $this;
    }
}