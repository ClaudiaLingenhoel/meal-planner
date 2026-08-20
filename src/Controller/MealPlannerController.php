<?php

namespace App\Controller;

use App\Entity\PlannedMeal;
use App\Entity\Recipe;
use App\Form\PlannedMealType;
use App\Repository\PlannedMealRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;

#[Route('/planner', name: 'app_meal_planner_')]
final class MealPlannerController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(PlannedMealRepository $plannedMealRepository): Response
    {
        $startOfWeek = new DateTime('monday this week');
        $endOfWeek = new DateTime('sunday this week');

        $plannedMeals = $plannedMealRepository->findForUserAndWeek(
            $this->getUser(),
            $startOfWeek,
            $endOfWeek
        );

        return $this->render('meal_planner/index.html.twig', [
            'plannedMeals' => $plannedMeals,
            'startOfWeek' => $startOfWeek,
            'endOfWeek' => $endOfWeek,
            'adminView' => false,
        ]);
    }

    #[Route('/admin/{id}', name: 'admin_view', methods: ['GET'])]
    public function adminView(User $user, PlannedMealRepository $plannedMealRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $startOfWeek = new DateTime('monday this week');
        $endOfWeek = new DateTime('sunday this week');

        $plannedMeals = $plannedMealRepository->findForUserAndWeek(
            $user,
            $startOfWeek,
            $endOfWeek
        );

        return $this->render('meal_planner/index.html.twig', [
            'plannedMeals' => $plannedMeals,
            'startOfWeek' => $startOfWeek,
            'endOfWeek' => $endOfWeek,
            'viewedUser' => $user,
            'adminView' => true,
        ]);
    }

    #[Route('/add/{id}', name: 'add', methods: ['GET', 'POST'])]
    public function add(Recipe $recipe, Request $request, EntityManagerInterface $entityManager): Response
    {
        $plannedMeal = new PlannedMeal();

        $plannedMeal->setRecipe($recipe);
        $plannedMeal->setUser($this->getUser());

        $form = $this->createForm(PlannedMealType::class, $plannedMeal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($plannedMeal);
            $entityManager->flush();

            return $this->redirectToRoute('app_meal_planner_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('meal_planner/add.html.twig', [
            'form' => $form,
            'recipe' => $recipe,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PlannedMeal $plannedMeal, EntityManagerInterface $entityManager): Response
    {
        if (
            $plannedMeal->getUser() !== $this->getUser()
        ) {
            throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(PlannedMealType::class, $plannedMeal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_meal_planner_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('meal_planner/edit.html.twig', [
            'form' => $form,
            'plannedMeal' => $plannedMeal,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, PlannedMeal $plannedMeal, EntityManagerInterface $entityManager): Response
    {
        if (
            $plannedMeal->getUser() !== $this->getUser()
        ) {
            throw $this->createAccessDeniedException();
        }

        if ($this->isCsrfTokenValid('delete' . $plannedMeal->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($plannedMeal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_meal_planner_index', [], Response::HTTP_SEE_OTHER);
    }
}
