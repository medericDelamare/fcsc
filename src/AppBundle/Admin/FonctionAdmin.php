<?php


namespace AppBundle\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FonctionAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('nom')
            ->add('code')
            ->add('type', ChoiceType::class, [
                'label' => 'Type de fonction',
                'choices' => [
                    'Bureau' => 'bureau',
                    'Responsable d\'équipe' => 'responsable-equipe',
                ]
            ])
            ->add('licencies', ModelType::class, [
                'multiple' => true,
                // your other options
            ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('nom')
            ->add('type');
    }
}