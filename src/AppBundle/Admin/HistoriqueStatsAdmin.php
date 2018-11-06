<?php


namespace AppBundle\Admin;


use AppBundle\Entity\Licencie;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class HistoriqueStatsAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('licencie')
            ->add('saison')
            ->add('nbButs')
            ->add('nbPasses')
            ->add('nbCartonsJaunes')
            ->add('nbCartonsRouges')
        ;
    }
    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper
            ->addIdentifier('licencie')
            ->add('saison')
            ->add('nbButs')
            ->add('nbPasses')
            ->add('nbCartonsJaunes')
            ->add('nbCartonsRouges')
            ;
    }
}