<?php


namespace AppBundle\Admin;


use AppBundle\Entity\Stade;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class StadeAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with("Informations générales")
            ->add('nom')
            ->add('type', null, [
                'help' => "Découvert, Couvert, etc..."
            ])
            ->add('natureSol', null, [
                "label" => "Nature du sol",
                'help' => "Gazon naturel, Synthéthique, Hybride, etc..."
            ])
            ->add('scriptGoogle')
            ->add('publie')
            ->end()
            ->with("Adresse")
            ->add('rue')
            ->add('codePostal')
            ->add('ville')
            ->end()
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nom')
            ->add('codePostal')
            ->add('ville')
            ->add('publie')
        ;
    }

    /**
     * @param Stade $object
     * @return string
     */
    public function toString($object)
    {
        return $object instanceof Stade
            ? $object->getNom()
            : 'Stade';
    }
}