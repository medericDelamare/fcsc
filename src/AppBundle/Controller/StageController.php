<?php

namespace AppBundle\Controller;


use AppBundle\Entity\StagePdf;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StageController extends Controller
{
    /**
     * @Route("/stages", name="stages")
     * @Template()
     */
    public function listAction()
    {
        $stages = $this->getDoctrine()->getManager()->getRepository(StagePdf::class)->findAll();

        return $this->render(':default:stages.html.twig', [
            'stages' => $stages
        ]);
    }
}