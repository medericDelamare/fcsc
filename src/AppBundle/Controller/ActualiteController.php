<?php


namespace AppBundle\Controller;


use AppBundle\Entity\Actualite;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ActualiteController extends Controller
{
    /**
     * @Route("/actualite/{id}", name="actualite")
     * @Template()
     */
    public function showAction($id)
    {
        $actualite = $this->getDoctrine()->getManager()->getRepository(Actualite::class)->find($id);



        // replace this example code with whatever you need
        return $this->render(':default:actualite.html.twig', [
            'actu' => $actualite
        ]);
    }
}