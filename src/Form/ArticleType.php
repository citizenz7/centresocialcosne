<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categorie;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArticleType extends AbstractType
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
            ->add('contenu', CKEditorType::class, [
                'label' => 'Contenu',
                'attr' => [
                    'class' => 'form-control mb-3'
                ]
            ])
            //->add('createdAt')
            //->add('updatedAt')
            ->add('image', FileType::class, [
                'label' => 'Image de l\'article',
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
            //->add('slug')
            //->add('auteur')
            ->add('categorie', EntityType::class, [
                'label' => 'Catégories du de l\'article (Choisissez une ou plusieurs catégories)',
                'class' => Categorie::class,
                'choice_label' => 'titre',
                'multiple' => true,
                'attr' => [
                    'class' => 'form-control mb-3'
                ]
            ])
            ->add('isFeatured', CheckboxType::class, [
                'label' => 'Article A la Une',
                'attr' => [
                    'class' => 'mx-2 mb-3'
                ]
            ])
            ->add('isAbout', CheckboxType::class, [
                'label' => 'Article A propos',
                'attr' => [
                    'class' => 'mx-2 mb-3'
                ]
            ])
            ->add('is_active', ChoiceType::class, [
                'label' => 'Article visible?',
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
            'data_class' => Article::class,
        ]);
    }
}
