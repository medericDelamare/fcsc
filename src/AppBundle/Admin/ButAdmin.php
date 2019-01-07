<?php


namespace AppBundle\Admin;


use AppBundle\Entity\Licencie;
use AppBundle\Repository\LicencieRepository;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ButAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('buteur', EntityType::class, [
                'class' => Licencie::class,
                'query_builder' => function(LicencieRepository $er) {
                    return $er->createQueryBuilder('l')
                        ->where('l.stats IS NOT NULL');
                }
            ])
            ->add('passeur', EntityType::class, [
                'class' => Licencie::class,
                'required' => false,
                'query_builder' => function(LicencieRepository $er) {
                    return $er->createQueryBuilder('l')
                        ->where('l.stats IS NOT NULL');
                }
            ])
            ->add('penalty', null, [
                'label' => 'Sur penalty'
            ])
            ->add('coupe', ChoiceType::class, [
                'label' => 'But en coupe',
                'choices' => [
                    null => null,
                    'U15' => 'U15',
                    'U17' => 'U17',
                    'U19' => 'U19',
                    'Senior' => 'Senior',
                    'cdm' => 'CDM',
                    'Veteran' => 'Veteran'
                ]
            ])
        ;
    }
    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper
            ->addIdentifier('id')
            ->add('buteur')
            ->add('passeur')
        ;
    }
}