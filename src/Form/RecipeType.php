<?php

namespace App\Form;

use App\Entity\DietaryType;
use App\Entity\Recipe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Validator\Constraints as Assert;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('cookingTimeMinutes', IntegerType::class, [
                'attr' => [
                    'min' => 1,
                ]
            ])
            ->add('shortDescription', TextType::class)
            ->add('instructions', TextareaType::class, [
                'attr' => [
                    'rows' => 10,
                ],
            ])
            ->add('source', UrlType::class, [
                'required' => false,
            ])
            ->add('servings', IntegerType::class, [
                'attr' => [
                    'min' => 1,
                ]
            ])
            ->add('caloriesPerServing', IntegerType::class, [
                'label' => 'Calories per serving',
                'required' => false,
                'attr' => [
                    'min' => 1,
                    'placeholder' => 'Optional',
                ],
            ])
            ->add('image', FileType::class, [
                'label' => 'Upload image',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Assert\File(
                        maxSize: '2048k',
                        extensions: [
                            'png',
                            'jpg',
                            'jpeg',
                        ],
                        extensionsMessage: 'Please upload a valid image (PNG, JPG, JPEG).',
                    )
                ]
            ])
            ->add('dietaryType', EntityType::class, [
                'class' => DietaryType::class,
                'choice_label' => 'name',
                'placeholder' => 'Select dietary type',
            ])
            ->add('recipeIngredients', CollectionType::class, [
                'entry_type' => RecipeIngredientType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}