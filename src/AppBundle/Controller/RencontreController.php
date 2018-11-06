<?php


namespace AppBundle\Controller;

use AppBundle\Entity\Rencontre;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class RencontreController extends Controller
{
    /**
     * @Route("/rencontre/{id}", name="rencontre")
     * @Template()
     */
    public function showAction($id)
    {
        $rencontre = $this->getDoctrine()->getRepository(Rencontre::class)->find($id);

        return $this->render(':default:rencontre.html.twig', [
            'rencontre' => $rencontre,
        ]);
    }
}