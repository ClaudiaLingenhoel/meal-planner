<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Entity\RecipeIngredient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeIngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ingredient', EntityType::class, [
                'class' => Ingredient::class,
                'choice_label' => 'name',
                'placeholder' => 'Select ingredient'
            ])
            ->add('quantity')
            ->add('unit', ChoiceType::class, [
                'choices' => [
                    'g' => 'g',
                    'ml' => 'ml',
                    'tsp' => 'tsp',
                    'tbsp' => 'tbsp',
                    'cup' => 'cup',
                    'piece' => 'piece',
                    'bunch' => 'bunch',
                    'slice' => 'slice',
                    'clove' => 'clove',
                    'pinch' => 'pinch',
                    'as needed' => 'as needed',
                    'to taste' => 'to taste',
                ],
                'placeholder' => 'Select unit',
            ])
            ->add('specification', null, [
                'label' => 'Shopping note',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Optional: additional shopping information',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RecipeIngredient::class,
        ]);
    }
}
