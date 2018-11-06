<?php


namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, ['attr' => [
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'Votre nom'],
                'constraints' => [
                    new NotBlank(array("message" => "Veuillez indiquer votre nom")),
                ]
            ])
            ->add('prenom', TextType::class, ['attr' => [
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'Votre prénom'],
                'constraints' => [
                    new NotBlank(array("message" => "Veuillez indiquer votre prénom")),
                ]
            ])
            ->add('email', EmailType::class, ['attr' => [
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'Votre adresse mail'],
                'constraints' => [
                    new NotBlank(array("message" => "Veuillez indiquer votre adresse mail")),
                    new Email(array("message" => "Votre adressse mail ne semble pas valide")),
                ]
            ])
            ->add('telephone', TextType::class, [
                'attr' => [
                    'placeholder' => 'Votre numéro de téléphone',
                    'class' => 'form-control',
                    'required' => 'required',
                ]
            ])
            ->add('message', TextareaType::class, ['attr' => [
                'rows' => 10,
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'Votre message'],
                'constraints' => [
                    new NotBlank(array("message" => "Veuillez indiquer votre message")),
                ]
            ])
        ;
    }

    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'error_bubbling' => true
        ));
    }

    public function getName()
    {
        return 'contact_form';
    }
}