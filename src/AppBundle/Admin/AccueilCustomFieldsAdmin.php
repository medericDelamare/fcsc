<?php


namespace AppBundle\Admin;


use AppBundle\Entity\AccueilCustomFields;
use AppBundle\Entity\PhotoAccueil;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class AccueilCustomFieldsAdmin  extends AbstractAdmin
{
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('create')
            ->remove('delete')
        ;

    }
    protected function configureFormFields(FormMapper $formMapper)
    {
        /** @var AccueilCustomFields $subject */
        $subject = $this->getSubject();
        $container = $this->getConfigurationPool()->getContainer();
        $fullPath = $container->get('request_stack')->getCurrentRequest()->getBasePath();

        $help = '';
        if ($subject->getNomImage()) {
            $help =
                '<p>Prévisualisation : <img width="auto" style="max-width:200px" src="'. $fullPath . '/pictures/Accueil/' .$subject->getNomImage() . '" /></p>';
        }

        $helpPartenaires = '';
        if ($subject->getNomImagePartenaire()) {
            $helpPartenaires =
                '<p>Prévisualisation : <img width="auto" style="max-width:200px" src="'. $fullPath . '/pictures/Accueil/' .$subject->getNomImagePartenaire() . '" /></p>';
        }
        $formMapper
            ->add('motDuPresident' , CKEditorType::class)
            ->add('file', FileType::class, [
                'label' => 'Photo mot du président',
                'required' => false,
                'help' => $help])
            ->add('filePartenaire', FileType::class, [
                'label' => 'Photo partenaires',
                'required' => false,
                'help' => $helpPartenaires])
        ;
    }
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('motDuPresident')
        ;
    }

    /**
     * @param AccueilCustomFields $photo
     */
    public function prePersist($photo)
    {
        if ($photo->getFile()) {
            $photo->refreshUpdated();
            $photo->setNomImage($photo->getFile()->getClientOriginalName());
        }

        if ($photo->getFilePartenaire()) {
            $photo->refreshUpdated();
            $photo->setNomImagePartenaire($photo->getFilePartenaire()->getClientOriginalName());
        }
    }

    /**
     * @param AccueilCustomFields $photo
     */
    public function preUpdate($photo)
    {
        if ($photo->getFile()){
            $photo->refreshUpdated();
            $photo->setNomImage($photo->getFile()->getClientOriginalName());
        }

        if ($photo->getFilePartenaire()){
            $photo->refreshUpdated();
            $photo->setNomImagePartenaire($photo->getFilePartenaire()->getClientOriginalName());
        }
    }
}