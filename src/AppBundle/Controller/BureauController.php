<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Bureau;
use AppBundle\Entity\Fonction;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BureauController extends Controller
{
    /**
     * @Route("/bureau", name="bureau")
     * @Template()
     */
    public function showAction(Request $request)
    {
        $fonctions = $this->getDoctrine()->getManager()->getRepository(Fonction::class)->getMembresBureau();



        // replace this example code with whatever you need
        return $this->render('default/bureau.html.twig', [
            'membres' => $fonctions
        ]);
    }
}