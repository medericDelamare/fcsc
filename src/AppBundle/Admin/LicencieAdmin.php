<?php


namespace AppBundle\Admin;


use AppBundle\Entity\Poste;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\HttpKernel\Kernel;

class LicencieAdmin extends AbstractAdmin
{
    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'ASC',
        '_sort_by' => 'nom',
    );

    /**
     * @var Kernel $kernel
     */
    private $kernel;

    /**
     * @param Kernel $kernel
     */
    public function setKernel(Kernel $kernel)
    {
        $this->kernel = $kernel;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Saison Actuelle')
                ->with('Informations Personelles', ['class' => 'col-md-6'])
                    ->add('nom', null, [
                        'label' => 'Nom',
                        'disabled'  => true,
                        ])
                    ->add('prenom', null, [
                        'label' => 'Prenom',
                        'disabled'  => true,
                    ])
                    ->add('email', null, [
                        'label' => 'Email',
                        'disabled'  => true,
                    ])
                    ->add('telephoneDomicile', null, [
                        'label' => 'Téléphone domicile',
                        'disabled'  => true,
                    ])
                    ->add('telephonePortable', null, [
                        'label' => 'Numéro de portable',
                        'disabled'  => true,
                    ])
                    ->add('dateDeNaissance', 'sonata_type_date_picker', [
                        'label' => 'Date de naissance',
                        'disabled'  => true,
                    ])
                    ->add('lieuDeNaissance', null, [
                        'label' => 'Lieu de Naissance',
                        'disabled'  => true,
                    ])
                    ->add('numeroLicence', null, [
                        'label' => 'Numéro de Licence',
                        'disabled'  => true,
                    ])
                ->end()
                ->with('Statistiques', ['class' => 'col-md-6'])
                    ->add('categorie', null, [
                        'label' => 'Catégorie',
                        'disabled'  => true,
                    ])
                    ->add('stats.poste', 'entity', [
                        'label' => 'Poste',
                        'class' => Poste::class
                    ])
                    ->add('stats.nbMatchs', null, [
                        'label' => 'Nombre de matchs joués'
                    ])
                    ->add('stats.butsA', null, [
                        'label' => 'Buts en équipes première'
                    ])
                    ->add('stats.butsB', null, [
                        'label' => 'Buts en équipe reserve'
                    ])
                    ->add('stats.butsCoupe', null, [
                        'label' => 'Buts en coupe'
                    ])
                    ->add('stats.cartonsJaunes', null, [
                        'label' => 'Cartons jaunes'
                    ])
                    ->add('stats.cartonsRouges', null, [
                        'label' => 'Cartons rouges'
                    ])
                    ->add('stats.buts', null, [
                        'label' => 'Total de buts'
                    ])
                    ->add('stats.passes', null, [
                        'label' => 'Passes',
                        'disabled'  => true,
                    ])
                ->end()
            ->end()
            ->tab('historique')
                ->add('historiqueStats', 'sonata_type_collection', [
                    'by_reference' => false,
                    'label' => false,
                    'btn_add' => 'Ajouter une année'
                ],[
                    'edit' => 'inline',
                    'inline' => 'table',
                ])
            ->end()

        ;

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nom')
            ->add('prenom')
            ->add('stats.poste')
            ->add('categorie');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nom')
            ->add('prenom')
            ->add('categorie')
            ->add('stats.poste')
            ->add('numeroLicence');
    }
}