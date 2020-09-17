<?php


namespace AppBundle\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class NombreEquipeAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('nom')
            ->add('nombre')
            ->add('ordre', null, [
                'help' => 'Ordre d\'affichage sur la page'
            ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('nom')
            ->add('nombre')
            ->add('ordre');
    }

    public function toString($object)
    {
        return $object->getNom();
    }
}