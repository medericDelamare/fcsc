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
    private $vicePresident2;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $vicePresident3;

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
    private $responsablePoleJeunes;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $responsablePoleSeniors;

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
    private $responsableU18;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $responsabeU15;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $responsableU13;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $responsableU11;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $responsableU9;

    /**
     * @var Licencie
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Licencie")
     */
    private $responsableU7;

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
    public function getVicePresident2()
    {
        return $this->vicePresident2;
    }

    /**
     * @param Licencie $vicePresident2
     * @return Bureau
     */
    public function setVicePresident2($vicePresident2)
    {
        $this->vicePresident2 = $vicePresident2;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getVicePresident3()
    {
        return $this->vicePresident3;
    }

    /**
     * @param Licencie $vicePresident3
     * @return Bureau
     */
    public function setVicePresident3($vicePresident3)
    {
        $this->vicePresident3 = $vicePresident3;
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
    public function getResponsablePoleJeunes()
    {
        return $this->responsablePoleJeunes;
    }

    /**
     * @param Licencie $responsablePoleJeunes
     * @return Bureau
     */
    public function setResponsablePoleJeunes($responsablePoleJeunes)
    {
        $this->responsablePoleJeunes = $responsablePoleJeunes;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getResponsablePoleSeniors()
    {
        return $this->responsablePoleSeniors;
    }

    /**
     * @param Licencie $responsablePoleSeniors
     * @return Bureau
     */
    public function setResponsablePoleSeniors($responsablePoleSeniors)
    {
        $this->responsablePoleSeniors = $responsablePoleSeniors;
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
    public function getResponsableU18()
    {
        return $this->responsableU18;
    }

    /**
     * @param Licencie $responsableU18
     * @return Bureau
     */
    public function setResponsableU18($responsableU18)
    {
        $this->responsableU18 = $responsableU18;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getResponsabeU15()
    {
        return $this->responsabeU15;
    }

    /**
     * @param Licencie $responsabeU15
     * @return Bureau
     */
    public function setResponsabeU15($responsabeU15)
    {
        $this->responsabeU15 = $responsabeU15;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getResponsableU13()
    {
        return $this->responsableU13;
    }

    /**
     * @param Licencie $responsableU13
     * @return Bureau
     */
    public function setResponsableU13($responsableU13)
    {
        $this->responsableU13 = $responsableU13;
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
    public function getResponsableU9()
    {
        return $this->responsableU9;
    }

    /**
     * @param Licencie $responsableU9
     * @return Bureau
     */
    public function setResponsableU9($responsableU9)
    {
        $this->responsableU9 = $responsableU9;
        return $this;
    }

    /**
     * @return Licencie
     */
    public function getResponsableU7()
    {
        return $this->responsableU7;
    }

    /**
     * @param Licencie $responsableU7
     * @return Bureau
     */
    public function setResponsableU7($responsableU7)
    {
        $this->responsableU7 = $responsableU7;
        return $this;
    }

}