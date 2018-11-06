<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Equipe;
use AppBundle\Entity\HistoriqueClassement;
use AppBundle\Entity\Rencontre;
use AppBundle\Entity\StatsParJournee;
use AppBundle\Service\Category\CategoryFactory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\JsonResponse;

class StatsController extends Controller
{
    /**
     * @Route("/statistiques/{category}", name="statistiques")
     * @Template()
     */
    public function showAction($category)
    {
        $equipes = $this->getDoctrine()->getRepository(Equipe::class)->getClassementByCategorie($category);
        $rencontres = $this->getDoctrine()->getRepository(Rencontre::class)->getDerniereJournee($category);
        $agendas = $this->getDoctrine()->getRepository(Rencontre::class)->getAgenda($category);
        $calendrier = $this->getDoctrine()->getRepository(Rencontre::class)->getCalendrierParCategorie($category);
        $distinctEquipes = $this->getDoctrine()->getRepository(Equipe::class)->findByCategorieOrderByNomParse($category);
        $classementParJournee = $this->getDoctrine()->getRepository(StatsParJournee::class)->findByCategOrderByJournee($category);

        $classementTriParEquipe = [];
        /** @var StatsParJournee $classementInfos */
        foreach ($classementParJournee as $classementInfos){
            $classementTriParEquipe[$classementInfos->getEquipe()->getNomParse()][] = $classementInfos->getPlace();
        }

        $nbJournees = [];
        for ($i = 1; $i<= (count($classementTriParEquipe)-1)*2 ; $i++){
            $nbJournees[] = $i;
        }


        $fcsc = null;
        $groupe = null;
        $division = null;

        /** @var Equipe $equipe */
        foreach ($distinctEquipes as $equipe){
            if ($equipe->getClub() && $equipe->getClub()->getId() == 1){
                $fcsc = $equipe;
            }

            if ($equipe->getGroupe()){
                $groupe = $equipe->getGroupe();
            }

            if ($equipe->getDivision()){
                $division = $equipe->getDivision();
            }

        }

        $categoryFormat = ucfirst($category);
        $categoryFormat = preg_replace('/(?=(?<!^)[[:upper:]])/', ' ', $categoryFormat);

        return $this->render(':default:statistiques.html.twig', [
            'categorie' => $categoryFormat,
            'equipes' => $equipes,
            'rencontres' => $rencontres,
            'agendas' => $agendas,
            'calendrier' => $calendrier,
            'equipeListe' => $distinctEquipes,
            'fcsc' => $fcsc,
            'classement_par_journee' => $classementTriParEquipe,
            'nb_journees' => $nbJournees,
            'division' => $division,
            'groupe' => $groupe,
        ]);
    }

    /**
     * @Route("/save-classement/{category}", name="save-classement")
     * @Template()
     */
    public function saveClassementAction($category){
        $factory = CategoryFactory::getInstance($this->getDoctrine()->getManager());
        $instance = $factory->createInstance($category);

        $em = $this->getDoctrine()->getManager();
        $journee = $this->getDoctrine()->getRepository(StatsParJournee::class)->findLastJourneeByCateg($category);
        if ($journee == null){
            $journee = 1;
        }
        foreach ($instance->getClassement() as $classementInfos){
            $statsParjournee = new StatsParJournee();
            $statsParjournee->setCategory($category);
            $statsParjournee->setEquipe(trim($classementInfos['equipe']));
            $statsParjournee->setJournee($journee['journee']+1);
            $statsParjournee->setPlace($classementInfos['place']);
            $em->persist($statsParjournee);
        }

        $em->flush();
        return $this->showAction($category);
    }

    /**
     * @param Equipe $equipe
     * @Route("/get-calendrier-par-equipe/{equipe}", name="calendrier-par-equipe")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getCalendrierParEquipe(Equipe $equipe){
        $equipes = $this->getDoctrine()->getRepository(Rencontre::class)->getCalendrierParEquipe($equipe);

        return $this->render(':default:tableauCalendrier.html.twig',[
            'equipes' => $equipes
        ]);
    }
}