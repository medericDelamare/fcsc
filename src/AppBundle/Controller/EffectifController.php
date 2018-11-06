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
    /**
     * @Route("/effectif/{category}", name="effectif")
     * @Template()
     */
    public function listByCategoryAction($category)
    {
        $em = $this->getDoctrine()->getManager();
        if ($category == 'Football-animation'){
            $u7 = $em->getRepository(Licencie::class)->findByCategory('U7');
            $u9 = $em->getRepository(Licencie::class)->findByCategory('U9');
            $u11 = $em->getRepository(Licencie::class)->findByCategory('U11');

            $joueurs = [
                'u7' => $u7,
                'u9' => $u9,
                'u11' => $u11
            ];
            return $this->render('default/effectifFootballAnimation.html.twig', [
                'joueursParCategorie' => $joueurs,
                'category' => $category,
                'nb_u7' => count($joueurs['u7']),
                'nb_u9' => count($joueurs['u9']),
                'nb_u11' => count($joueurs['u11']),
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