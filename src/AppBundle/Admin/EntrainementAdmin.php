<?php


namespace AppBundle\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Xmon\ColorPickerTypeBundle\Form\Type\ColorPickerType;

class EntrainementAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('titre')
            ->add('jour', ChoiceType::class, [
                'choices' => [
                    'Lundi' => 1,
                    'Mardi' => 2,
                    'Mercredi' => 3,
                    'Jeudi' => 4,
                    'Vendredi' => 5,
                ]
            ])
            ->add('heureDepart', TimeType::class, [
                'label' => 'Heure de départ (HH:MM)',
                'input' => 'string',
            ])
            ->add('heureFin', TimeType::class, [
                'label' => 'Heure de fin (HH:MM)',
                'input' => 'string',
            ])
            ->add('couleur', ColorPickerType::class, [
                'required' => true
            ])
            ->add('categorie', ChoiceType::class, [
                'choices' => [
                    'Ecole de foot' => 'edf',
                    'U13 -> Vétérans' => 'u13-veterans',
                ]
            ])
            ->add('stade')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('titre')
            ->add('jour')
            ->add('heureDepart')
            ->add('heureFin')
            ->add('couleur')
            ->add('categorie');

    }
}