<?php


namespace AppBundle\Admin;


use AppBundle\Entity\Licencie;
use AppBundle\Repository\LicencieRepository;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

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