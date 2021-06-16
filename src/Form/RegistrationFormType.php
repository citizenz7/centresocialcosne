<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Prénom'
                ]
            ])
            ->add('nom', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Nom'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'E-mail'
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'merci de cochez la case',
                'mapped' => false,
                'attr' => [
                    'class' => 'mt-1 ms-2 mb-3'
                ],
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos Conditions Générales d\'Utilisation.',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'mapped' => false,
                'type' => PasswordType::class,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Votre mot de passe doit comporter au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'first_options' => ['label' => false, 'attr' => [ 'class' => 'form-control mb-3', 'placeholder' => 'Mot de passe']],
                'second_options' => ['label' => false, 'attr' => [ 'class' => 'form-control mb-3', 'placeholder' => 'Confirmez le mot de passe']]
            ])
            ->add('fonction', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Votre fonction au Centre Social'
                ]
            ])
            ->add('presentation', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control mb-3',
                    'rows' => '4',
                    'placeholder' => 'Présentation courte'
                ],
            ]) 
            ->add('image', FileType::class, [
                'label' => 'Image de votre profil',
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '4M',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg'
                        ],
                        'mimeTypesMessage' => 'L\'image envoyée n\'est pas valide',
                    ])
                ]
            ])
            ->add('facebook', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Votre profil Facebook',
                ]
            ])
            ->add('twitter', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Votre profil Twitter'
                ]
            ])
            ->add('instagram', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Votre profil Instagram'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
