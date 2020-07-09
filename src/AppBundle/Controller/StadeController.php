<?php


namespace AppBundle\Controller;


use AppBundle\Entity\Stade;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StadeController extends Controller
{
    /**
     * @Route("/stades", name="stades")
     * @Template()
     */
    public function showAction()
    {
        $stades = $this->getDoctrine()->getRepository(Stade::class)->findBy([
            'publie' => true
        ]);
        return $this->render('default/stades.html.twig', [
            'stades' => $stades
        ]);
    }
}