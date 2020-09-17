<?php


namespace AppBundle\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class NombreLicenciesParAnneeAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('anneeDepart', null,[
                'label' => 'Année de départ',
                'help' => 'Au format AAAA (ex: 2017)'
            ])
            ->add('anneeFin', null,[
                'label' => 'Année de fin',
                'help' => 'Au format AAAA (ex: 2017)'
            ])
            ->add('nombreLicencies', null,[
                'label' => 'Nombre de licenciés'
            ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('anneeDepart')
            ->add('anneeFin')
            ->add('nombreLicencies');
    }

    public function toString($object)
    {
        return $object->getAnneeDepart(). '-' . $object->getAnneeFin();
    }
}