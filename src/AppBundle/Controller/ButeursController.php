<?php

namespace AppBundle\Controller;


use AppBundle\Entity\But;
use AppBundle\Entity\Joueur;
use AppBundle\Entity\Licencie;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ButeursController extends Controller
{
    /**
     * @Route("/buteurs", name="buteurs")
     * @Template()
     */
    public function showAction()
    {
        $buteurs = $this->getDoctrine()->getRepository(But::class)->findAll();

        $buteursSenior=[];
        $buteursVeterans=[];
        $buteursCdm=[];
        $buteursU19=[];
        $buteursU17=[];
        $buteursU15=[];

        foreach ($buteurs as $buteur){
            if ($buteur->getStatsRencontres()){
                $categorie = $buteur->getStatsRencontres()->getRencontre()->getEquipeDomicile()->getCategorie();

                switch ($categorie){
                    case 'seniorA':
                        $buteur->getButeur()->getStats()->incrementButA();
                        $buteursSenior[$buteur->getButeur()->getNomComplet()] = $buteur->getButeur();
                        break;
                    case 'seniorB':
                        $buteur->getButeur()->getStats()->incrementButB();
                        $buteursSenior[$buteur->getButeur()->getNomComplet()] = $buteur->getButeur();
                        break;
                    case 'veteran':
                        $buteur->getButeur()->getStats()->incrementButA();
                        $buteursVeterans[$buteur->getButeur()->getNomComplet()] = $buteur->getButeur();
                        break;
                    case 'cdm':
                        $buteur->getButeur()->getStats()->incrementButA();
                        $buteursCdm[$buteur->getButeur()->getNomComplet()] = $buteur->getButeur();
                        break;
                    case 'U19':
                        $buteur->getButeur()->getStats()->incrementButA();
                        $buteursU19[$buteur->getButeur()->getNomComplet()] = $buteur->getButeur();
                        break;
                    case 'U17A':
                        $buteur->getButeur()->getStats()->incrementButA();
                        $buteursU17[$buteur->getButeur()->getNomComplet()] = $buteur->getButeur();
                        break;
                    case 'U17B':
                        $buteur->getButeur()->getStats()->incrementButB();
                        $buteursU17[$buteur->getButeur()->getNomComplet()] = $buteur->getButeur();
                        break;
                    case 'U15A':
                        $buteur->getButeur()->getStats()->incrementButA();
                        $buteursU15[$buteur->getButeur()->getNomComplet()] = $buteur->getButeur();
                        break;
                    case 'U15B':
                        $buteur->getButeur()->getStats()->incrementButB();
                        $buteursU15[$buteur->getButeur()->getNomComplet()] = $buteur->getButeur();
                        break;
                }
            }

            if (!is_null($buteur->getCoupe())){
                switch ($buteur->getCoupe()){
                    case 'Senior':
                        $buteur->getButeur()->getStats()->incrementButCoupe();
                        $buteursSenior[$buteur->getButeur()->getNomComplet()] = $buteur->getButeur();
                        break;

                    case 'Veteran':
                        $buteur->getButeur()->getStats()->incrementButCoupe();
                        $buteursVeterans[$buteur->getButeur()->getNomComplet()] = $buteur->getButeur();
                        break;

                    case 'cdm':
                        $buteur->getButeur()->getStats()->incrementButCoupe();
                        $buteursCdm[$buteur->getButeur()->getNomComplet()] = $buteur->getButeur();
                        break;

                    case 'U19':
                        $buteur->getButeur()->getStats()->incrementButCoupe();
                        $buteursU19[$buteur->getButeur()->getNomComplet()] = $buteur->getButeur();
                        break;

                    case 'U17':
                        $buteur->getButeur()->getStats()->incrementButCoupe();
                        $buteursU17[$buteur->getButeur()->getNomComplet()] = $buteur->getButeur();
                        break;

                    case 'U15':
                        $buteur->getButeur()->getStats()->incrementButCoupe();
                        $buteursU15[$buteur->getButeur()->getNomComplet()] = $buteur->getButeur();
                        break;
                }
            }
        }

        return $this->render(':default:buteurs.html.twig', [
            'seniors' => $buteursSenior,
            'veterans' => $buteursVeterans,
            'cdm' => $buteursCdm,
            'U19' => $buteursU19,
            'U17'=> $buteursU17,
            'U15'=> $buteursU15
        ]);
    }
}