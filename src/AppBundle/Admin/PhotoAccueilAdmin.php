<?php


namespace AppBundle\Admin;


use AppBundle\Entity\PhotoAccueil;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PhotoAccueilAdmin extends AbstractAdmin
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
            'label' => 'Photo',
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
     * @param PhotoAccueil $photo
     */
    public function prePersist($photo)
    {
        if ($photo->getFile()) {
            $photo->refreshUpdated();
            $photo->setNom($photo->getFile()->getClientOriginalName());
        }
    }

    /**
     * @param PhotoAccueil $photo
     */
    public function preUpdate($photo)
    {
        if ($photo->getFile()){
            $photo->refreshUpdated();
            $photo->setNom($photo->getFile()->getClientOriginalName());
        }
    }
}