<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Bureau;
use AppBundle\Entity\Fonction;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ResponsablesController extends Controller
{
    /**
     * @Route("/responsables-par-équipe", name="responsables")
     * @Template()
     */
    public function showAction(Request $request)
    {
        $responsables = $this->getDoctrine()->getManager()->getRepository(Fonction::class)->getResponsables();

        return $this->render('default/responsablesCategories.html.twig', [
            'responsables' => $responsables
        ]);
    }
}