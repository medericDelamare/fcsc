<?php

namespace AppBundle\Admin;


use AppBundle\Entity\Equipe;
use AppBundle\Entity\Rencontre;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class RencontreAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper

            ->add('equipeDomicile', EntityType::class, [
                'class'=>Equipe::class
            ])
            ->add('equipeExterieure', EntityType::class, [
                'class'=>Equipe::class
            ])
            ->add('journee')
            ->add('score')
            ->add('date')
        ;
    }
    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper
            ->addIdentifier('equipeDomicile')
            ->add('equipeExterieure')
            ->add('journee')
            ->add('score')
        ;
    }
}