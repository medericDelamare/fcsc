<?php


namespace AppBundle\Admin;


use AppBundle\Entity\Secretariat;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SecretariatAdmin extends AbstractAdmin
{
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('create')
            ->remove('delete');

    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        /** @var Secretariat $subject */
        $subject = $this->getSubject();
        $container = $this->getConfigurationPool()->getContainer();
        $fullPath = $container->get('request_stack')->getCurrentRequest()->getBasePath();

        $help = '';
        if ($subject->getImage()) {
            $help =
                '<p>Prévisualisation : <img width="auto" style="max-width:200px" src="' . $fullPath . '/pictures/Secretariat/' . $subject->getImage() . '" /></p>';
        }
        $formMapper
            ->add('titre', TextType::class)
            ->add('texte', CKEditorType::class,[
                'required'=>true
            ])
            ->add('file', FileType::class, [
                'label' => 'Photo',
                'required' => false,
                'help' => $help]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('titre');
    }

    /**
     * @param Secretariat $photo
     */
    public function prePersist($photo)
    {
        if ($photo->getFile()) {
            $photo->refreshUpdated();
            $photo->setImage($photo->getFile()->getClientOriginalName());
        }
    }

    /**
     * @param Secretariat $photo
     */
    public function preUpdate($photo)
    {
        if ($photo->getFile()) {
            $photo->refreshUpdated();
            $photo->setImage($photo->getFile()->getClientOriginalName());
        }
    }
}