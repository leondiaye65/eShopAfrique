<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserRegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom', TextType::Class,[
                'label'=> false,
                'attr' => [
                    "placeholder" => "Saisir votre prenom"
                ]
            ])
            ->add('email', EmailType::class,[
                'label'=> false,
                'attr' => [
                    "placeholder" => "Saisir votre email"
                ]
            ])
            ->add('plainPassword', RepeatedType::class,[
                "type" => PasswordType::class,
                "invalid_message" => "Les champs de mdp doivent être identiques",
                'first_options' => [
                    'label'=> false,
                    'attr' => [
                        "placeholder" => "Saisir votre mot de passe"
                    ]
                ],
                'second_options' => [
                    'label'=> false,
                    'attr' => [
                        "placeholder" => "Repetez votre mot de passe"
                ]
            ],

        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
