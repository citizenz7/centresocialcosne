<?php

namespace App\Form;

use App\Entity\Page;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class PageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ]
            ])
            ->add('contenu', CKEditorType::class)
            //->add('slug')
            //->add('createdAt')
            //->add('updatedAt')
            //->add('auteur')

            ->add('file1', FileType::class, [
                'label' => 'Fichier #1 de la page',
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '4M',
                        'mimeTypes' => [
                            'application/pdf'
                        ],
                        'mimeTypesMessage' => 'Le fichier envoyé n\'est pas valide',
                    ])
                ]
            ])
            ->add('file2', FileType::class, [
                'label' => 'Fichier #2 de la page',
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '4M',
                        'mimeTypes' => [
                            'application/pdf'
                        ],
                        'mimeTypesMessage' => 'Le fichier envoyé n\'est pas valide',
                    ])
                ]
            ])
            ->add('file3', FileType::class, [
                'label' => 'Fichier #3 de la page',
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '4M',
                        'mimeTypes' => [
                            'application/pdf'
                        ],
                        'mimeTypesMessage' => 'Le fichier envoyé n\'est pas valide',
                    ])
                ]
            ])
            ->add('file4', FileType::class, [
                'label' => 'Fichier #4 de la page',
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '4M',
                        'mimeTypes' => [
                            'application/pdf'
                        ],
                        'mimeTypesMessage' => 'Le fichier envoyé n\'est pas valide',
                    ])
                ]
            ])
            ->add('file5', FileType::class, [
                'label' => 'Fichier #5 de la page',
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '4M',
                        'mimeTypes' => [
                            'application/pdf'
                        ],
                        'mimeTypesMessage' => 'Le fichier envoyé n\'est pas valide',
                    ])
                ]
            ])

            ->add('is_featured', CheckboxType::class, [
                'label' => 'Page A LA UNE',
                'required' => false,
                'attr' => [
                    'class' => 'mx-2'
                ]
            ])
            ->add('is_about', CheckboxType::class, [
                'label' => 'Page A PROPOS',
                'required' => false,
                'attr' => [
                    'class' => 'mx-2'
                ]
            ])
            ->add('is_team', CheckboxType::class, [
                'label' => 'Page EQUIPE',
                'required' => false,
                'attr' => [
                    'class' => 'mx-2'
                ]
            ])
            ->add('is_partenaire', CheckboxType::class, [
                'label' => 'Page PARTENAIRES',
                'required' => false,
                'attr' => [
                    'class' => 'mx-2'
                ]
            ])
            ->add('is_conseiladmin', CheckboxType::class, [
                'label' => 'Page CONSEIL ADMINISTRATION',
                'required' => false,
                'attr' => [
                    'class' => 'mx-2'
                ]
            ])
            ->add('is_projetsocial', CheckboxType::class, [
                'label' => 'Page PROJET SOCIAL',
                'required' => false,
                'attr' => [
                    'class' => 'mx-2'
                ]
            ])
            ->add('is_benevole', CheckboxType::class, [
                'label' => 'Page BENEVOLES',
                'required' => false,
                'attr' => [
                    'class' => 'mx-2'
                ]
            ])
            ->add('is_historique', CheckboxType::class, [
                'label' => 'Page HISTORIQUE',
                'required' => false,
                'attr' => [
                    'class' => 'mx-2'
                ]
            ])
            ->add('is_organigramme', CheckboxType::class, [
                'label' => 'Page ORGANIGRAMME',
                'required' => false,
                'attr' => [
                    'class' => 'mx-2'
                ]
            ])
            ->add('is_venir', CheckboxType::class, [
                'label' => 'Page VENIR AU CENTRE SOCIAL',
                'required' => false,
                'attr' => [
                    'class' => 'mx-2'
                ]
            ])
            ->add('is_mentionslegales', CheckboxType::class, [
                'label' => 'Page MENTIONS LEGALES',
                'required' => false,
                'attr' => [
                    'class' => 'mx-2'
                ]
            ])
            ->add('is_inscription', CheckboxType::class, [
                'label' => 'Page INSCRIPTIONS',
                'required' => false,
                'attr' => [
                    'class' => 'mx-2'
                ]
            ])
            ->add('is_active', ChoiceType::class, [
                'label' => 'Page activée (visible) ?',
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
            'data_class' => Page::class,
        ]);
    }
}
