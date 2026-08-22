<?php

namespace App\Service;

use App\Entity\PlannedMeal;

final class ShoppingListBuilder
{
    /**
     * @param iterable<PlannedMeal> $plannedMeals
     *
     * @return array<string, array{
     *     key: string,
     *     name: string,
     *     unit: string,
     *     quantity: ?float,
     *     specification: ?string
     * }>
     */
    public function build(iterable $plannedMeals): array
    {
        $shoppingList = [];

        foreach ($plannedMeals as $plannedMeal) {
            $recipe = $plannedMeal->getRecipe();
            $plannedServings = $plannedMeal->getServings();
            $recipeServings = $recipe?->getServings();
            if (null === $recipe || null === $plannedServings || null === $recipeServings || $recipeServings < 1) {
                continue;
            }

            $factor = $plannedServings / $recipeServings;

            foreach ($recipe->getRecipeIngredients() as $recipeIngredient) {
                $ingredient = $recipeIngredient->getIngredient();
                $unit = $recipeIngredient->getUnit();
                if (null === $ingredient || null === $unit) {
                    continue;
                }

                $quantity = $recipeIngredient->getQuantity();
                $specification = $recipeIngredient->getSpecification();

                if (in_array($unit, ['to taste', 'as needed'], true)) {
                    $scaledQuantity = null;
                } elseif (null === $quantity && 'pinch' !== $unit) {
                    $scaledQuantity = null;
                } else {
                    $scaledQuantity = (float) ($quantity ?? 1) * $factor;

                    if ('pinch' === $unit && $scaledQuantity < 1) {
                        $scaledQuantity = 1.0;
                    }
                }

                $key = $ingredient->getId().'_'.$unit.'_'.($specification ?? '');

                if (!isset($shoppingList[$key])) {
                    $shoppingList[$key] = [
                        'key' => $key,
                        'name' => (string) $ingredient->getName(),
                        'unit' => $unit,
                        'quantity' => $scaledQuantity,
                        'specification' => $specification,
                    ];
                } elseif (null !== $scaledQuantity) {
                    $shoppingList[$key]['quantity'] = ($shoppingList[$key]['quantity'] ?? 0) + $scaledQuantity;
                }
            }
        }

        return $shoppingList;
    }
}
