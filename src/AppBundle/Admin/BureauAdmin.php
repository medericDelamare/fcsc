<?php

namespace AppBundle\Admin;


use AppBundle\Entity\Licencie;
use AppBundle\Repository\LicencieRepository;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class BureauAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('president', EntityType::class,[
                'class' => Licencie::class,
            ])
            ->add('vicePresident', EntityType::class,[
                'class' => Licencie::class,
            ])
            ->add('secretaire', EntityType::class,[
                'class' => Licencie::class,
            ])
            ->add('tresorier', EntityType::class,[
                'class' => Licencie::class,
            ])
            ->add('responsableEquipement', EntityType::class,[
                'class' => Licencie::class,
            ])
            ->add('responsableVeterans', EntityType::class,[
                'class' => Licencie::class,
            ])
            ->add('responsableCdm', EntityType::class,[
                'class' => Licencie::class,
            ])
            ->add('responsableSeniorA', EntityType::class,[
                'class' => Licencie::class,
            ])
            ->add('responsableSeniorB', EntityType::class,[
                'class' => Licencie::class,
            ])
            ->add('responsableU19', EntityType::class,[
                'class' => Licencie::class,
            ])
            ->add('responsableU17', EntityType::class,[
                'class' => Licencie::class,
            ])
            ->add('responsableU15', EntityType::class,[
                'class' => Licencie::class,
            ])
            ->add('responsableU12U13', EntityType::class,[
                'class' => Licencie::class,
            ])
            ->add('responsableU11', EntityType::class,[
                'class' => Licencie::class,
            ])
            ->add('responsableU10', EntityType::class,[
                'class' => Licencie::class,
            ])
            ->add('responsableU6U9', EntityType::class,[
                'class' => Licencie::class,
            ])
            ->add('responsablePoleFeminin', EntityType::class,[
                'class' => Licencie::class,
            ])
            ->add('responsableGardiens', EntityType::class,[
                'class' => Licencie::class,
            ])
        ;
    }
    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper
            ->addIdentifier('president')
        ;
    }
}