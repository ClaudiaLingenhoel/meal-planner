<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/recipe', name: 'app_recipe_')]
final class RecipeController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(RecipeRepository $recipeRepository): Response
    {
        return $this->render('recipe/index.html.twig', [
            'recipes' => $recipeRepository->findAll(),
            'pageTitle' => 'All Recipes',
        ]);
    }

    #[Route('/mine', name: 'mine', methods: ['GET'])]
    public function mine(RecipeRepository $recipeRepository): Response
    {
        return $this->render('recipe/index.html.twig', [
            'recipes' => $recipeRepository->findBy([
                'creator' => $this->getUser(),
            ]),
            'pageTitle' => 'My Recipes',
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $recipe = new Recipe();
        $recipe->setCreator($this->getUser());

        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $today = new DateTime("now");
            $recipe->setCreatedAt($today);

            $entityManager->persist($recipe);
            $entityManager->flush();

            return $this->redirectToRoute('app_recipe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recipe/new.html.twig', [
            'recipe' => $recipe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Recipe $recipe): Response
    {
        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe,
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Recipe $recipe, EntityManagerInterface $entityManager): Response
    {
        if (
            $recipe->getCreator() !== $this->getUser()
            && !$this->isGranted('ROLE_ADMIN')
        ) {
            throw $this->createAccessDeniedException();
        }


        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $today = new DateTime("now");
            $recipe->setUpdatedAt($today);

            $entityManager->flush();

            return $this->redirectToRoute('app_recipe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recipe/edit.html.twig', [
            'recipe' => $recipe,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Recipe $recipe, EntityManagerInterface $entityManager): Response
    {
        if (
            $recipe->getCreator() !== $this->getUser()
            && !$this->isGranted('ROLE_ADMIN')
        ) {
            throw $this->createAccessDeniedException();
        }

        if ($this->isCsrfTokenValid('delete' . $recipe->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($recipe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_recipe_index', [], Response::HTTP_SEE_OTHER);
    }
}
