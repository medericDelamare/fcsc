<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Joueur;
use AppBundle\Entity\Licencie;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Class ProfileController
 * @package AppBundle\Controller
 */
class ProfileController extends Controller
{
    /**
     * @Route("/profile/{id}", name="profile")
     * @Template()
     */
    public function profileShowAction($id){
        $joueur = $this->getDoctrine()->getManager()->getRepository(Licencie::class)->find($id);

        /** @var \DateTime $birthDate */
        $birthDate = $joueur->getDateDeNaissance();
        $to   = new \DateTime('today');
        $age = $birthDate->diff($to)->y;


        $saisons = [];
        foreach ($joueur->getHistoriqueStats() as $historiqueStat){
            $saisons[] = $historiqueStat->getSaison();
        }
        array_push($saisons, '18/19');
        $buts = [];
        foreach ($joueur->getHistoriqueStats() as $historiqueStat){
            $buts[] = $historiqueStat->getNbButs();
        }
        array_push($buts, count($joueur->getButs()));
        $passes = [];
        foreach ($joueur->getHistoriqueStats() as $historiqueStat){
            $passes[] = $historiqueStat->getNbPasses();
        }
        array_push($passes,count($joueur->getPasses()));
        $cartonsJ = [];
        foreach ($joueur->getHistoriqueStats() as $historiqueStat) {
            $cartonsJ[] = $historiqueStat->getNbCartonsJaunes();
        }
        array_push($cartonsJ, count($joueur->getStatsRencontresCartonsJaunes()));
        $cartonsR = [];
        foreach ($joueur->getHistoriqueStats() as $historiqueStat){
            $cartonsR[] = $historiqueStat->getNbCartonsRouges();
        }
        array_push($cartonsR, count($joueur->getStatsRencontresCartonsRouges()));



        return $this->render(':default:profil.html.twig', [
            'joueur' => $joueur,
            'age' => $age,
            'saisons' => $saisons,
            'cartonsJ' => $cartonsJ,
            'cartonsR' => $cartonsR,
            'buts' => $buts,
            'passes' => $passes
        ]);
    }
}