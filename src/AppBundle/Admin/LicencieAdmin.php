<?php


namespace AppBundle\Admin;


use AppBundle\Entity\Categorie;
use AppBundle\Entity\Licencie;
use AppBundle\Entity\Poste;
use AppBundle\Entity\SousCategorie;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\HttpKernel\Kernel;

class LicencieAdmin extends AbstractAdmin
{
    private $cat;

    public $nbLicencieSansPoste = 0;

    public function setCategorie($cat)
    {
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
            ])
            ->add('prenom', null, [
                'label' => 'Prenom',
            ])
            ->add('email', null, [
                'label' => 'Email',
            ])
            ->add('telephoneDomicile', null, [
                'label' => 'Téléphone domicile',
            ])
            ->add('telephonePortable', null, [
                'label' => 'Numéro de portable',
            ])
            ->add('dateDeNaissance', 'sonata_type_date_picker', [
                'label' => 'Date de naissance',
            ])
            ->add('lieuDeNaissance', null, [
                'label' => 'Lieu de Naissance',
            ])
            ->add('numeroLicence', null, [
                'label' => 'Numéro de Licence',
            ])
            ->end()
            ->with('Statistiques', ['class' => 'col-md-6'])
            ->add('categorie', null, [
                'label' => 'Catégorie',
            ])
            ->add('joueur')
            ->add('dirigeant')
            ->add('educateur')
            ->end()
            ->end();

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager();
        $sousCategories = $em->getRepository(SousCategorie::class)->findAll();

        $categories = [];
        /** @var SousCategorie $sousCategory */
        foreach ($sousCategories as $sousCategory) {
            $categories[$sousCategory->getNom()] = $sousCategory->getNom();
        }

        $datagridMapper
            ->add('nom')
            ->add('prenom')
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
            ->add('numeroLicence');
    }

    /**
     * @param Licencie $user
     */
    public function preValidate($user)
    {
        parent::preValidate($user);
        $user->setNationalite("Française");

    }

    public function createQuery($context = 'list')
    {
        $nbLicencieSansPoste = 0;
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager();
        $currentUser = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();


        $categories = $em->getRepository(Categorie::class)->findAll();
        $sousCategories = [];
        foreach ($currentUser->getRoles() as $role) {
            /** @var Categorie $categorie */
            foreach ($categories as $categorie) {
                if ($role == $categorie->getRole()) {
                    foreach ($categorie->getSousCategories() as $sousCategorie) {
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
        foreach ($query->execute() as $licencie) {
            if (is_null($licencie->getStats()) || ($licencie->getStats() && is_null($licencie->getStats()->getPoste()))) {
                $nbLicencieSansPoste++;
            }
        }

        $this->nbLicencieSansPoste = $nbLicencieSansPoste;

        return $query;
    }
}