<?php
/**
 * Created by PhpStorm.
 * User: delamare
 * Date: 11/08/2017
 * Time: 19:12
 */

namespace AppBundle\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class UserAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('username', null, [
                'label' => 'Nom d\'utilisateur'
            ])
            ->add('lastName', null, [
                'label' => 'Nom',
                'required' => true
            ])
            ->add('firstName', null, [
                'label' => 'Prénom',
                'required' => true
            ])
            ->add('plainPassword', TextType::class, [
                'label' => 'Mot de passe initial'
            ])
            ->add('plainPassword', TextType::class, [
                'label' => 'Mot de passe initial'
            ])
            ->add('email')
            ->add('enabled', null, [
                'label' => 'Activé'
            ])
            ->add('roles', 'choice', [
            'expanded' => true,
            'multiple' => true,
            'choices' => [
                "Utilisateur" => "ROLE_USER",
                "Administrateur" => "ROLE_ADMIN",
                "Super Administrateur" => "ROLE_SUPER_ADMIN",
            ],
            'label' => 'Roles'
        ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('email')
            ->add('roles')
            ->add('username');
    }
}