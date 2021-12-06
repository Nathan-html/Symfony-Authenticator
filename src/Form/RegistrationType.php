<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('first_name')
            ->add('last_name')
            ->add('email', EmailType::class, [
                'label' => 'email',
            ])
            ->add('password_not_hashed', PasswordType::class, [
                'label' => 'mot de passe',
                'mapped' => false,
            ])
            ->add('confirm_password', PasswordType::class, [
                'label' => 'mot de passe',
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'mot-de-passe',
                    'style' => 'width:25vw;',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Please enter a password',]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'votre mot de passe dois contenir {{ limit }} charactere au minimum',
                        'max' => 20,
                        'maxMessage' => 'votre mot de passe dois contenir {{ limit }} charactere au maximum',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
