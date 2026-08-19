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

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('cookingTimeMinutes')
            ->add('shortDescription')
            ->add('instructions', TextareaType::class, [
                'attr' => [
                    'rows' => 10,
                ],
            ])
            ->add('source')
            ->add('servings')
            ->add('image')
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
