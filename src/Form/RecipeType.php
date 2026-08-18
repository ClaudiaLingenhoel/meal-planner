<?php

namespace App\Form;

use App\Entity\DietaryType;
use App\Entity\Recipe;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('cookingTimeMinutes')
            ->add('shortDescription')
            ->add('instructions')
            ->add('source')
            ->add('servings')
            ->add('image')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('dietaryType', EntityType::class, [
                'class' => DietaryType::class,
                'choice_label' => 'id',
            ])
            ->add('creator', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
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
