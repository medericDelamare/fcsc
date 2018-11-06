<?php


namespace AppBundle\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ProduitAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('categorie')
            ->add('nom')
            ->add('prix')
            ->add('photo')
            ->add('logoObligatoire')
            ->add('initiales')
            ->add('logo')
            ->add('reference')
            ->add('nomNike');
    }
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nom')
            ->add('categorie')
            ->add('prix')
            ->add('photo')
            ->add('logo_obligatoire')
            ->add('reference')
            ->add('nom_nike');
    }
}