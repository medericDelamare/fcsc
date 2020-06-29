<?php


namespace AppBundle\Controller;


use AppBundle\Entity\Actualite;
use AppBundle\Entity\Secretariat;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecretariatController extends Controller
{
    /**
     * @Route("/secretariat", name="secretariat")
     * @Template()
     */
    public function showAction()
    {
        $secretariat = $this->getDoctrine()->getRepository(Secretariat::class)->getFirst();
        return $this->render('default/secretariat.html.twig',[
            'secretariat' => $secretariat
        ]);
    }
}