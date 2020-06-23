<?php


namespace AppBundle\Admin;


use AppBundle\Entity\MotPresident;
use AppBundle\Entity\PhotoAccueil;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class MotPresidentAdmin  extends AbstractAdmin
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
        $subject = $this->getSubject();
        $container = $this->getConfigurationPool()->getContainer();
        $fullPath = $container->get('request_stack')->getCurrentRequest()->getBasePath();

        $help = '';
        if ($subject->getNomImage()) {
            $help =
                '<p>Prévisualisation : <img width="auto" style="max-width:200px" src="'. $fullPath . '/pictures/Accueil/' .$subject->getNomImage() . '" /></p>';
        }
        $formMapper
            ->add('motDuPresident' , CKEditorType::class)
            ->add('file', FileType::class, [
                'label' => 'Photo',
                'required' => false,
                'help' => $help])
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
     * @param MotPresident $photo
     */
    public function prePersist($photo)
    {
        if ($photo->getFile()) {
            $photo->refreshUpdated();
            $photo->setNomImage($photo->getFile()->getClientOriginalName());
        }
    }

    /**
     * @param MotPresident $photo
     */
    public function preUpdate($photo)
    {
        if ($photo->getFile()){
            $photo->refreshUpdated();
            $photo->setNomImage($photo->getFile()->getClientOriginalName());
        }
    }
}