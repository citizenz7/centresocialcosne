<?php

namespace App\Form;

use App\Entity\Activite;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ActiviteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre',
                'attr' => [
                    'class' => 'form-control mb-3'
                ]
            ])
            //->add('slug')
            ->add('description', CKEditorType::class, [
                'label' => 'Contenu',
                'attr' => [
                    'class' => 'form-control mb-3'
                ]
            ])
            ->add('image', FileType::class, [
                'label' => 'Image de l\'activité',
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
            ->add('file1', FileType::class, [
                'label' => 'Fichier #1 de l\'activité',
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '3M',
                        'mimeTypes' => [
                            'application/pdf'
                        ],
                        'mimeTypesMessage' => 'Le fichier envoyé n\'est pas valide',
                    ])
                ]
            ])
            ->add('file2', FileType::class, [
                'label' => 'Fichier #2 de l\'activité',
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '3M',
                        'mimeTypes' => [
                            'application/pdf'
                        ],
                        'mimeTypesMessage' => 'Le fichier envoyé n\'est pas valide',
                    ])
                ]
            ])
            ->add('file3', FileType::class, [
                'label' => 'Fichier #3 de l\'activité',
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '3M',
                        'mimeTypes' => [
                            'application/pdf'
                        ],
                        'mimeTypesMessage' => 'Le fichier envoyé n\'est pas valide',
                    ])
                ]
            ])

            //->add('createdAt')
            //->add('updatedAt')
            ->add('categorie', EntityType::class, [
                'label' => 'Catégories de l\'activité (Choisissez une ou plusieurs catégories)',
                'class' => Categorie::class,
                'choice_label' => 'titre',
                'multiple' => true,
                'attr' => [
                    'class' => 'form-control mb-3'
                ]
            ])
            ->add('is_active', ChoiceType::class, [
                'label' => 'Activité visible ?',
                'choices' => [
                    'oui' => 1,
                    'non' => 0
                ],
                'attr' => [
                    'class' => 'form-control mb-3'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Activite::class,
        ]);
    }
}
