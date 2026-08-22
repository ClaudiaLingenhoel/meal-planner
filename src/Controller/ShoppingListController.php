<?php

namespace App\Controller;

use App\Repository\PlannedMealRepository;
use App\Service\ShoppingListBuilder;
use App\Service\WeekResolver;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
final class ShoppingListController extends AbstractController
{
    #[Route('/shopping-list', name: 'app_shopping_list', methods: ['GET'])]
    public function index(
        Request $request,
        PlannedMealRepository $plannedMealRepository,
        ShoppingListBuilder $shoppingListBuilder,
        WeekResolver $weekResolver,
    ): Response
    {
        $startOfWeek = $weekResolver->resolve($request->query->getString('week'));
        $endOfWeek = $startOfWeek->modify('+6 days');

        $plannedMeals = $plannedMealRepository->findForUserAndWeekWithIngredients(
            $this->getUser(),
            $startOfWeek,
            $endOfWeek
        );

        $shoppingList = $shoppingListBuilder->build($plannedMeals);

        return $this->render('shopping_list/index.html.twig', [
            'shoppingList' => $shoppingList,
            'startOfWeek' => $startOfWeek,
            'endOfWeek' => $endOfWeek,
        ]);
    }
}
