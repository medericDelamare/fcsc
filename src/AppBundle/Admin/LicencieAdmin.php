<?php


namespace AppBundle\Admin;


use AppBundle\Entity\Categorie;
use AppBundle\Entity\Licencie;
use AppBundle\Entity\Poste;
use AppBundle\Entity\SousCategorie;
use Doctrine\ORM\Query;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\HttpKernel\Kernel;

class LicencieAdmin extends AbstractAdmin
{
    private $cat;

    public $nbLicencieSansPoste = 0;

    public function setCategorie($cat){
        $this->cat = $cat;
    }

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
        $em = $this->getConfigurationPool()->getContainer()->get('Doctrine')->getManager();
        $sousCategories = $em->getRepository(SousCategorie::class)->findAll();

        $categories = [];
        /** @var SousCategorie $sousCategory */
        foreach ($sousCategories as $sousCategory) {
            $categories[$sousCategory->getNom()] = $sousCategory->getNom();
        }

        $datagridMapper
            ->add('nom')
            ->add('prenom')
            ->add('stats.poste')
            ->add('categorie', 'doctrine_orm_choice', array('label' => 'Categorie',
                'field_options' => array(
                    'required' => false,
                    'choices' => $categories,
                    'multiple' => true,
                ),
                'field_type' => 'choice'
            ));;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nom')
            ->add('prenom')
            ->add('categorie')
            ->add('stats.poste', null, [
                'label' => 'Poste'
            ])
            ->add('numeroLicence');
    }

    public function createQuery($context = 'list')
    {
        $nbLicencieSansPoste = 0;
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager();
        $currentUser = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();


        $categories = $em->getRepository(Categorie::class)->findAll();
        $sousCategories = [];
        foreach ($currentUser->getRoles() as $role){
            /** @var Categorie $categorie */
            foreach ($categories as $categorie){
                if ($role == $categorie->getRole()){
                    foreach ($categorie->getSousCategories() as $sousCategorie){
                        $sousCategories[] = $sousCategorie->getNom();
                    }
                }
            }
        }
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->in($query->getRootAliases()[0] . '.categorie', ':my_param')
        );
        $query->setParameter('my_param', $sousCategories);

        /** @var Licencie $licencie */
        foreach ($query->execute() as $licencie){
            if (is_null($licencie->getStats()) || ($licencie->getStats() && is_null($licencie->getStats()->getPoste()))){
                $nbLicencieSansPoste ++;
            }
        }

        $this->nbLicencieSansPoste = $nbLicencieSansPoste;

        return $query;
    }
}