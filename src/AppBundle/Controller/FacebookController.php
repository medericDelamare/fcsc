<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Joueur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FacebookController extends Controller
{
    /**
     * @Route("/facebook/publish-anniversaire", name="facebook-publish")
     */
    public function publishAction(){
        $joueurs = $this->getDoctrine()->getManager()->getRepository(Joueur::class)->findByBirthdayNow();

        $message = null;
        $noms = null;
        $age = null;

        $now = new \DateTime();

        if (count($joueurs) == 1 ){
            /** @var Joueur $joueur */
            foreach ($joueurs as $joueur){
                $infos = $noms . $joueur->getPrenom() . ' ' . $joueur->getNom() . ' ( ' . $joueur->getCategorie()->getNom();
                $age = $now->format('Y') - $joueur->getDateNaissance()->format('Y');
                $message = '🎂Alerte anniversaire🎂'.PHP_EOL .  PHP_EOL.'L\'USCL souhaite un joyeux anniversaire à ' . $infos . ' ) qui fête aujourd\'hui ses ' . $age . ' ans'.PHP_EOL.PHP_EOL.'⚽🔵⚪';
            }

        } elseif (count($joueurs) > 1){
            $lastJoueur = end($joueurs);
            /** @var Joueur $joueur */
            foreach ($joueurs as $joueur){
                if ($joueur === $lastJoueur){
                    $noms = $noms . 'et ' . $joueur->getPrenom() . ' ' . $joueur->getNom() . ' ( ' . $joueur->getCategorie()->getNom() . ' ) ';
                    $dernierAge = $now->format('Y') - $joueur->getDateNaissance()->format('Y') . ' ans';
                    $age = $age . ' et ' .$dernierAge;
                } else{
                    $noms = $noms . $joueur->getPrenom() . ' ' . $joueur->getNom() . ' ( ' . $joueur->getCategorie()->getNom() . ' ), ';
                    $age = $age . $now->format('Y') - $joueur->getDateNaissance()->format('Y') . ' ans,';
                }

                $message = 'Alerte anniversaire'.PHP_EOL .  PHP_EOL.'L\'USCL souhaite un joyeux anniversaire à ' . $noms . ' ) qui fête respectivement leurs ' . $age . ' ans'.PHP_EOL.PHP_EOL.'⚽🔵⚪';

            }
        }

        $this->get('app_core.facebook')->poster($message);

        return new Response("Post Envoyé");
    }
}