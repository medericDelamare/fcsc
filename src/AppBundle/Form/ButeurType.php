<?php

namespace AppBundle\Form;


use AppBundle\Entity\Licencie;
use AppBundle\Entity\StatsRencontre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class ButeurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('statsRencontre', EntityType::class, [
                'class' => StatsRencontre::class
            ])
            ->add('buteur', EntityType::class, [
                'class' => Licencie::class
            ])
            ->add('passeur', EntityType::class, [
                'class' => Licencie::class
            ])
        ;
    }
}