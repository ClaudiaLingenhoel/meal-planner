<?php

namespace App\Controller;

use App\Repository\PlannedMealRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
final class ShoppingListController extends AbstractController
{
    #[Route('/shopping-list', name: 'app_shopping_list')]
    public function index(Request $request, PlannedMealRepository $plannedMealRepository): Response
    {
        $startOfWeek = $this->getStartOfWeek($request);
        $endOfWeek = $startOfWeek->modify('+6 days');

        $plannedMeals = $plannedMealRepository->findForUserAndWeek(
            $this->getUser(),
            $startOfWeek,
            $endOfWeek
        );

        $shoppingList = [];
        foreach ($plannedMeals as $plannedMeal) {
            $recipe = $plannedMeal->getRecipe();

            $factor = $plannedMeal->getServings() / $recipe->getServings();

            foreach ($recipe->getRecipeIngredients() as $recipeIngredient) {
                $ingredient = $recipeIngredient->getIngredient();
                $unit = $recipeIngredient->getUnit();
                $quantity = $recipeIngredient->getQuantity();
                $specification = $recipeIngredient->getSpecification();

                if (in_array($unit, ['to taste', 'as needed'])) {
                    $scaledQuantity = null;
                } else {
                    $quantity = $quantity ?? 1;
                    $scaledQuantity = $quantity * $factor;

                    if ($unit === 'pinch' && $scaledQuantity < 1) {
                        $scaledQuantity = 1;
                    }
                }

                $key = $ingredient->getId() . '_' . $unit . '_' . ($specification ?? '');

                // ingredient not yet on shopping list
                if (!isset($shoppingList[$key])) {
                    $shoppingList[$key] = [
                        'key' => $key,
                        'name' => $ingredient->getName(),
                        'unit' => $unit,
                        'quantity' => $scaledQuantity,
                        'specification' => $specification,
                    ];
                } elseif ($scaledQuantity !== null) {
                    $shoppingList[$key]['quantity'] += $scaledQuantity;
                }
            }
        }

        return $this->render('shopping_list/index.html.twig', [
            'shoppingList' => $shoppingList,
            'startOfWeek' => $startOfWeek,
            'endOfWeek' => $endOfWeek,
        ]);
    }

    private function getStartOfWeek(Request $request): DateTimeImmutable
    {
        $week = $request->query->getString('week');
        if ('' === $week) {
            return new DateTimeImmutable('monday this week');
        }

        $selectedDate = DateTimeImmutable::createFromFormat('!Y-m-d', $week);
        $errors = DateTimeImmutable::getLastErrors();
        if (false === $selectedDate || (false !== $errors && (0 < $errors['warning_count'] || 0 < $errors['error_count']))) {
            return new DateTimeImmutable('monday this week');
        }

        return $selectedDate->modify('monday this week');
    }
}
