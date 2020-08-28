<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Actualite;
use AppBundle\Entity\AccueilCustomFields;
use AppBundle\Entity\NombreEquipe;
use AppBundle\Entity\NombreLicenciesParAnnee;
use AppBundle\Entity\PhotoAccueil;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $actualites = $this->getDoctrine()->getRepository(Actualite::class)->findPublishedActualiteOrderByPosition();
        $derniresPhotos = $this->getDoctrine()->getRepository(PhotoAccueil::class)->getLastPictures();
        $nombreEquipes = $this->getDoctrine()->getRepository(NombreEquipe::class)->findAllOrdered();
        $statsLicencies = $this->getDoctrine()->getRepository(NombreLicenciesParAnnee::class)->getAllOrderByAnneeDebut();

        $annees = [];
        $nbLicencies = [];
        /**
         * @var NombreLicenciesParAnnee $stat
         */
        foreach ($statsLicencies as $stat){
            $annees[] = substr((string)$stat->getAnneeDepart(),2,2) . '/' . substr((string)$stat->getAnneeFin(),2,2);
            $nbLicencies[] = $stat->getNombreLicencies();
        }
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'actus' => $actualites,
            'option' => $this->getDoctrine()->getRepository(AccueilCustomFields::class)->find(1),
            'photos' => $derniresPhotos,
            'nb_equipes' => $nombreEquipes,
            'annees' => $annees,
            'nbLicencies' => $nbLicencies,
        ]);
    }
}
