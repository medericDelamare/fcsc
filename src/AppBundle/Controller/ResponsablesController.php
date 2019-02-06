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


        $responsables = [
            [
                'licencie' => $bureau->getResponsableSeniorA(),
                'titre' =>  'Seniors A'
            ],
            [
                'licencie' => $bureau->getResponsableSeniorB(),
                'titre' => 'Seniors B'
            ],
            [
                'licencie' => $bureau->getResponsableVeterans(),
                'titre' => 'Vétérans'
            ],
            [
                'licencie' => $bureau->getResponsableCdm(),
                'titre' => 'Championnat Dim. Matin'
            ],
            [
                'licencie' => $bureau->getResponsableU19(),
                'titre' => 'U19'
            ],
            [
                'licencie' => $bureau->getResponsableU17(),
                'titre' => 'U17'
            ],
            [
                'licencie' => $bureau->getResponsableU15(),
                'titre' => 'U15'
            ],
            [
                'licencie' => $bureau->getResponsableEcoleDeFoot(),
                'titre' => 'Ecole de Foot'
            ],
            [
                'licencie' => $bureau->getResponsableU12U13(),
                'titre' => 'U12 - U13'
            ],
            [
                'licencie' => $bureau->getResponsableU11(),
                'titre' => 'U11'
            ],
            [
                'licencie' => $bureau->getResponsableU10(),
                'titre' => 'U10'
            ],
            [
                'licencie' => $bureau->getResponsableU6U9(),
                'titre' => 'U6 à U9'
            ],
            [
                'licencie' => $bureau->getResponsablePoleFeminin(),
                'titre' => 'Pôle feminin'
            ],
            [
                'licencie' => $bureau->getResponsableGardiens(),
                'titre' => 'Gardiens de buts'
            ],



        ];

        return $this->render(':default:responsablesCategories.html.twig', [
            'responsables' => $responsables
        ]);
    }
}