<?php


namespace AppBundle\Admin;


use AppBundle\Entity\Actualite;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ActualiteAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $subject = $this->getSubject();
        $container = $this->getConfigurationPool()->getContainer();
        $fullPath = $container->get('request_stack')->getCurrentRequest()->getBasePath();

        $help = '';
        if ($subject->getPhoto()) {
            $help =
                '<p>Prévisualisation : <img width="auto" style="max-width:200px" src="'. $fullPath . '/pictures/Actualites/' .$subject->getPhoto() . '" /></p>';
        }

        $formMapper
            ->add('titre')
            ->add('contenu', CKEditorType::class, [
            ])
            ->add('publie', null, [
                'label' => 'Publié'
            ])
            ->add('file', FileType::class, [
                'label' => 'Photo (900x300)',
                'required' => false,
                'help' => $help
            ])
            ->add('position')
        ;
    }
    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper
            ->addIdentifier('titre')
        ;
    }



    /**
     * @param Actualite $actualite
     */
    public function prePersist($actualite)
    {
        if ($actualite->getFile()) {
            $actualite->refreshUpdated();
            $actualite->setPhoto($actualite->getFile()->getClientOriginalName());
        }
    }

    /**
     * @param Actualite $actualite
     */
    public function preUpdate($actualite)
    {
        if ($actualite->getFile()){
            $actualite->refreshUpdated();
            $actualite->setPhoto($actualite->getFile()->getClientOriginalName());
        }
    }
}