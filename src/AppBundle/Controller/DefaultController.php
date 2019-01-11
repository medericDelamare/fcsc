<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Actualite;
use AppBundle\Entity\CustomFields;
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
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'actus' => $actualites,
            'option' => $this->getDoctrine()->getRepository(CustomFields::class)->find(1),
            'photos' => $derniresPhotos
        ]);
    }
}
