<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Joueur;
use AppBundle\Entity\Licencie;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class EffectifController
 * @package AppBundle\Controller
 *
 */
class EffectifController extends Controller
{
    private $categories = [
        'Libre / U6 (- 6 ans)',
        'Libre / U6 F (- 6 ans F)',
        'Libre / U7 (- 7 ans)',
        'Libre / U7 F (- 7 ans F)',
        'Libre / U8 (- 8 ans)',
        'Libre / U8 F (- 8 ans F)',
        'Libre / U9 (- 9 ans)',
        'Libre / U9 F (- 9 ans F)',
        'Libre / U10 (- 10 ans)',
        'Libre / U10 F (- 10 ans F)',
        'Libre / U11 (- 11 ans)',
        'Libre / U11 F (- 11 ans F)',
    ];

    /**
     * @Route("/effectif/{category}", name="effectif")
     * @Template()
     */
    public function listByCategoryAction($category)
    {
        $em = $this->getDoctrine()->getManager();
        if ($category == 'Football-animation'){

            $joueurs = [];

            foreach ($this->categories as $categorie){
                foreach ($this->getDoctrine()->getManager()->getRepository(Licencie::class)->findByCategorie($categorie) as $licencie){
                    $joueurs[] = $licencie;
                }
            }
            return $this->render('default/effectifFootballAnimation.html.twig', [
                'joueurs' => $joueurs,
                'category' => $category,
            ]);
        } else{
            $joueurs = $em->getRepository(Licencie::class)->findByCategoryOrderByPoste($category);
            return $this->render('default/effectif.html.twig', [
                'joueurs' => $joueurs,
                'category' => $category,
                'nb_joueurs' => count($joueurs)
            ]);
        }




    }
}