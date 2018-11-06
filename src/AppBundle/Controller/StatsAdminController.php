<?php
namespace AppBundle\Controller;


use AppBundle\Entity\But;
use AppBundle\Entity\Joueur;
use AppBundle\Entity\Licencie;
use AppBundle\Entity\Rencontre;
use AppBundle\Form\ButeurType;
use GuzzleHttp\Psr7\Request;
use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
use Sonata\CoreBundle\Form\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;

class StatsAdminController extends Controller{

    /**
     * @Route("/add", name="stats_add")
     */
    public function addAction(){
        $request = $this->getRequest();
        $joueursBdd = $this->getDoctrine()->getManager()->getRepository(Licencie::class)->findAll();

        /** @var Joueur $joueur */
        foreach ($joueursBdd as $joueur){
            $joueurs[$joueur->getNom() . ' - ' . $joueur->getPrenom()] = $joueur;
        }

        $form = $this->createFormBuilder()
            ->add('match', EntityType::class, [
                'class' => Rencontre::class,
                'label' => 'Match concerné'
            ])
            ->add('test', 'sonata_type_collection', [
                'entry_type' => ButeurType::class,
                'label' => false,
                'btn_add' => 'Ajouter un buteur',
            ],[
                'edit' => 'inline',
                'inline' => 'table',
            ])
            ->add('passeurs', ChoiceType::class, [
                'choices' => $joueurs,
                'multiple' => true,
                'required' => false,
            ])
            ->add('buteurs', ChoiceType::class, [
                'choices' => $joueurs,
                'multiple' => true,
                'required' => false,
                'label' => 'Buteurs'
            ])
            ->add('nbMatchs', ChoiceType::class, [
                'choices' => $joueurs,
                'multiple' => true,
                'required' => false,
                'label' => 'Joueurs ayant participé à ce match'
            ])
            ->add('cartonsJaunes', ChoiceType::class, [
                'choices' => $joueurs,
                'multiple' => true,
                'required' => false,
            ])
            ->add('cartonsRouges', ChoiceType::class, [
                'choices' => $joueurs,
                'multiple' => true,
                'required' => false,
            ])
            ->add('Envoyer', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $task = $form->getData();

            /** @var Joueur $passeur */
            foreach ($task['passeurs'] as $passeur){
                $passeur->setPasses($passeur->getPasses() + 1);
                $em->persist($passeur);
            }

            /** @var Joueur $buteur */
            foreach ($task['buteurs'] as $buteur){
                $buteur->setButs($buteur->getButs() + 1);
                $em->persist($buteur);
            }

            /** @var Joueur $nbMatch */
            foreach ($task['nbMatchs'] as $nbMatch){
                $nbMatch->setNbMatchs($nbMatch->getNbMatchs() + 1);
                $em->persist($nbMatch);
            }

            /** @var Joueur $cartonJ */
            foreach ($task['cartonsJaunes'] as $cartonJ){
                $cartonJ->setCartonsJaunes($cartonJ->getCartonsJaunes() + 1);
                $em->persist($cartonJ);
            }

            /** @var Joueur $cartonR */
            foreach ($task['cartonsRouges'] as $cartonR){
                $cartonR->setCartonsRouges($cartonR->getCartonsRouges() + 1);
                $em->persist($cartonR);
            }

            $em->flush();
            return $this->redirectToRoute('stats_add');
        }
        return $this->render('@SonataAdmin/Stats/stats.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}