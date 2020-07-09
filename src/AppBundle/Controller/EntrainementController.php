<?php


namespace AppBundle\Controller;


use AppBundle\Entity\EntrainementCalendrier;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EntrainementController extends Controller
{
    /**
     * @Route("/entrainements", name="entrainements")
     * @Template()
     */
    public function showAction(Request $request)
    {
        $evenementsEdf = $this->getDoctrine()->getManager()->getRepository(EntrainementCalendrier::class)->findBy(['categorie' => 'edf']);
        $u13toVeteran = $this->getDoctrine()->getManager()->getRepository(EntrainementCalendrier::class)->findBy(['categorie' => 'u13-veterans']);

        $edf = [];
        /** @var EntrainementCalendrier $entrainement */
        foreach ($evenementsEdf as $entrainement) {
            $edf[] = $this->buildEvent($entrainement);
        }

        $others = [];
        /** @var EntrainementCalendrier $item */
        foreach ($u13toVeteran as $entrainement) {
            $others[] = $this->buildEvent($entrainement);
        }

        return $this->render('default/entrainements.html.twig', [
            'edf' => $edf,
            'others' => $others
        ]);
    }

    private function buildEvent(EntrainementCalendrier $entrainement)
    {
        $event = [];

        $event['title'] = $entrainement->getTitre() . ' - ' . $entrainement->getStade()->getNom();
        $event['start'] = $entrainement->getHeureDepart();
        $event['end'] = $entrainement->getHeureFin();
        $event['backgroundColor'] = '#' . $entrainement->getCouleur();
        $event['dow'] = [(int)$entrainement->getJour()];
        $event['textColor'] = 'black';

        return $event;
    }
}