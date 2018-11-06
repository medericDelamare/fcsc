<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Bureau;
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
        $bureau = $this->getDoctrine()->getManager()->getRepository(Bureau::class)->find(1);



        // replace this example code with whatever you need
        return $this->render(':default:bureau.html.twig', [
            'bureau' => $bureau
        ]);
    }
}