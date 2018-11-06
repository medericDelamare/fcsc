<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Bureau;
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
        $bureau = $this->getDoctrine()->getManager()->getRepository(Bureau::class)->find(1);

        return $this->render(':default:responsablesCategories.html.twig', [
            'bureau' => $bureau
        ]);
    }
}