<?php

namespace AppBundle\Admin;


use AppBundle\Entity\Club;
use AppBundle\Entity\Equipe;
use AppBundle\Entity\Licencie;
use AppBundle\Entity\Rencontre;
use AppBundle\Entity\StatsRencontre;
use AppBundle\Repository\LicencieRepository;
use AppBundle\Repository\RencontreRepository;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class StatsRencontreAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('rencontre', EntityType::class, [
                'class' => Rencontre::class,
                'query_builder' => function(RencontreRepository $er) {
                    return $er->createQueryBuilder('r')
                        ->join(Equipe::class, 'ed', 'WITH', 'ed.id = r.equipeDomicile')
                        ->join(Equipe::class, 'ee', 'WITH', 'ee.id = r.equipeExterieure')
                        ->where('ed.club = 1')
                        ->orWhere('ee.club = 1');
                }
            ])
            ->add('joueurs', EntityType::class, [
                'class' => Licencie::class,
                'query_builder' => function(LicencieRepository $er) {
                    return $er->createQueryBuilder('l')
                        ->where('l.stats IS NOT NULL');
                }
            ])
            ->add('cartonsJaunes', EntityType::class, [
                'class' => Licencie::class,
                'query_builder' => function(LicencieRepository $er) {
                    return $er->createQueryBuilder('l')
                        ->where('l.stats IS NOT NULL');
                }
            ])
            ->add('cartonsRouges', EntityType::class, [
                'class' => Licencie::class,
                'query_builder' => function(LicencieRepository $er) {
                    return $er->createQueryBuilder('l')
                        ->where('l.stats IS NOT NULL');
                }
            ])
            ->add('buts', 'sonata_type_collection', [
                'by_reference' => false,
                'label' => false,
                'btn_add' => 'Ajouter un buteur'
            ],[
                'edit' => 'inline',
                'inline' => 'table',
            ])
        ;
    }
    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper
            ->addIdentifier('id')
            ->add('rencontre')
        ;
    }
}