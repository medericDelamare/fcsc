<?php

namespace AppBundle\Admin;


use AppBundle\Entity\StagePdf;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class StagePdfAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $subject = $this->getSubject();
        $container = $this->getConfigurationPool()->getContainer();
        $fullPath = $container->get('request_stack')->getCurrentRequest()->getBasePath();

        $help = '';
        if ($subject->getNom()) {
            $help =
                '<p>Prévisualisation : <img width="auto" style="max-width:200px" src="'. $fullPath . '/pictures/Accueil/' .$subject->getNom() . '" /></p>';
        }
        $formMapper
            ->add('file', FileType::class, [
                'label' => 'Stage (.pdf)',
                'required' => false,
                'help' => $help
            ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper
            ->addIdentifier('nom');
    }

    /**
     * @param StagePdf $stage
     */
    public function prePersist($stage)
    {
        if ($stage->getFile()) {
            $stage->refreshUpdated();
            $stage->setNom($stage->getFile()->getClientOriginalName());
        }
    }

    /**
     * @param StagePdf $stage
     */
    public function preUpdate($stage)
    {
        if ($stage->getFile()){
            $stage->refreshUpdated();
            $stage->setNom($stage->getFile()->getClientOriginalName());
        }
    }
}