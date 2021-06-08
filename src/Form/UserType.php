<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
            ])
            //->add('roles')
            //->add('password')
            ->add('prenom', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
            ])
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
            ])
            //->add('isVerified')
            ->add('presentation', CKEditorType::class, [
                'attr' => [
                    'class' => 'mb-3'
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
            ->add('fonction', TextType::class, [
                'label' => 'Votre fonction au centre social',
                'attr' => [
                    'class' => 'form-control mb-3'
                ]
            ])
            ->add('facebook', TextType::class, [
                'label' => 'Votre profil Facebook',
                'required' => false,
                'attr' => [
                    'class' => 'form-control mb-3'
                ]
            ])
            ->add('twitter', TextType::class, [
                'label' => 'Votre profil Twitter',
                'required' => false,
                'attr' => [
                    'class' => 'form-control mb-3'
                ]
            ])
            ->add('instagram', TextType::class, [
                'label' => 'Votre profil Instagram',
                'required' => false,
                'attr' => [
                    'class' => 'form-control mb-3'
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
