<?php

namespace App\Controller;

use App\Entity\DietaryType;
use App\Entity\Recipe;
use App\Entity\User;
use App\Form\RecipeType;
use App\Repository\DietaryTypeRepository;
use App\Repository\RecipeRepository;
use App\Service\FileUploader;
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
    public function index(
        Request $request,
        RecipeRepository $recipeRepository,
        DietaryTypeRepository $dietaryTypeRepository,
    ): Response
    {
        $user = $this->getUser();
        $defaultDietaryType = $user instanceof User ? $user->getDietaryType() : null;
        $filters = $this->filtersFromRequest($request, $dietaryTypeRepository, $defaultDietaryType);

        return $this->render('recipe/index.html.twig', [
            'recipes' => $recipeRepository->findForBrowser($filters),
            'dietaryTypes' => $dietaryTypeRepository->findBy([], ['restrictionLevel' => 'ASC']),
            'filters' => $filters,
            'pageTitle' => 'All Recipes',
            'mineOnly' => false,
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/mine', name: 'mine', methods: ['GET'])]
    public function mine(
        Request $request,
        RecipeRepository $recipeRepository,
        DietaryTypeRepository $dietaryTypeRepository,
    ): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $filters = $this->filtersFromRequest($request, $dietaryTypeRepository, $user->getDietaryType());

        return $this->render('recipe/index.html.twig', [
            'recipes' => $recipeRepository->findForBrowser($filters, $user),
            'dietaryTypes' => $dietaryTypeRepository->findBy([], ['restrictionLevel' => 'ASC']),
            'filters' => $filters,
            'pageTitle' => 'My Recipes',
            'mineOnly' => true,
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $recipe = new Recipe();
        $recipe->setCreator($this->getUser());

        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $today = new DateTime("now");
            $recipe->setCreatedAt($today);

            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $newFilename = $fileUploader->upload($imageFile);
                $recipe->setImage($newFilename);
            }

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
    public function edit(Request $request, Recipe $recipe, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
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

            $imageFile = $form->get('image')->getData();
            $oldImagePath = null;

            if ($imageFile) {
                $newFilename = $fileUploader->upload($imageFile);
                $oldImage = $recipe->getImage();

                if ($oldImage) {
                    $oldImagePath = $fileUploader->getTargetDirectory() . '/' . $oldImage;
                }

                $recipe->setImage($newFilename);
            }

            $entityManager->flush();

            if ($oldImagePath && is_file($oldImagePath)) {
                unlink($oldImagePath);
            }

            return $this->redirectToRoute('app_recipe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recipe/edit.html.twig', [
            'recipe' => $recipe,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Recipe $recipe, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        if (
            $recipe->getCreator() !== $this->getUser()
            && !$this->isGranted('ROLE_ADMIN')
        ) {
            throw $this->createAccessDeniedException();
        }

        if ($this->isCsrfTokenValid('delete' . $recipe->getId(), $request->getPayload()->getString('_token'))) {
            $image = $recipe->getImage();
            $imagePath = $image ? $fileUploader->getTargetDirectory() . '/' . $image : null;

            $entityManager->remove($recipe);
            $entityManager->flush();

            if ($imagePath && is_file($imagePath)) {
                unlink($imagePath);
            }
        }

        return $this->redirectToRoute('app_recipe_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @return array{
     *     search: string,
     *     dietaryType: ?int,
     *     dietaryLevel: ?int,
     *     maxTime: ?int,
     *     maxCalories: ?int,
     *     sort: string
     * }
     */
    private function filtersFromRequest(
        Request $request,
        DietaryTypeRepository $dietaryTypeRepository,
        ?DietaryType $defaultDietaryType = null,
    ): array
    {
        $dietaryType = $defaultDietaryType;
        if ($request->query->has('dietaryType')) {
            $dietaryTypeId = $this->positiveIntegerQueryValue($request, 'dietaryType');
            $dietaryType = null === $dietaryTypeId ? null : $dietaryTypeRepository->find($dietaryTypeId);
        }

        $allowedSorts = [
            'newest',
            'oldest',
            'title_asc',
            'title_desc',
            'time_asc',
            'time_desc',
            'calories_asc',
            'calories_desc',
        ];
        $sort = $request->query->getString('sort', 'newest');

        return [
            'search' => trim($request->query->getString('search')),
            'dietaryType' => $dietaryType?->getId(),
            'dietaryLevel' => $dietaryType?->getRestrictionLevel(),
            'maxTime' => $this->positiveIntegerQueryValue($request, 'maxTime'),
            'maxCalories' => $this->positiveIntegerQueryValue($request, 'maxCalories'),
            'sort' => in_array($sort, $allowedSorts, true) ? $sort : 'newest',
        ];
    }

    private function positiveIntegerQueryValue(Request $request, string $name): ?int
    {
        $value = $request->query->get($name);
        if (null === $value || '' === $value) {
            return null;
        }

        $integer = filter_var($value, FILTER_VALIDATE_INT, [
            'options' => ['min_range' => 1],
        ]);

        return false === $integer ? null : $integer;
    }
}