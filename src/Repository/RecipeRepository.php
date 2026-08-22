<?php

namespace App\Repository;

use App\Entity\Recipe;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recipe>
 */
class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

    /**
     * @param array{
     *     search: string,
     *     dietaryLevel: ?int,
     *     maxTime: ?int,
     *     maxCalories: ?int,
     *     sort: string
     * } $filters
     *
     * @return list<Recipe>
     */
    public function findForBrowser(array $filters, ?User $creator = null): array
    {
        $queryBuilder = $this->createQueryBuilder('recipe')
            ->addSelect('dietaryType', 'creator')
            ->join('recipe.dietaryType', 'dietaryType')
            ->join('recipe.creator', 'creator');

        if (null !== $creator) {
            $queryBuilder
                ->andWhere('recipe.creator = :creator')
                ->setParameter('creator', $creator);
        }

        if ('' !== $filters['search']) {
            $queryBuilder
                ->leftJoin('recipe.recipeIngredients', 'recipeIngredient')
                ->leftJoin('recipeIngredient.ingredient', 'ingredient')
                ->andWhere(
                    'LOWER(recipe.title) LIKE LOWER(:search)'
                    .' OR LOWER(recipe.shortDescription) LIKE LOWER(:search)'
                    .' OR LOWER(recipe.instructions) LIKE LOWER(:search)'
                    .' OR LOWER(ingredient.name) LIKE LOWER(:search)'
                )
                ->setParameter('search', '%'.$filters['search'].'%')
                ->distinct();
        }

        if (null !== $filters['dietaryLevel']) {
            $queryBuilder
                ->andWhere('dietaryType.restrictionLevel <= :dietaryLevel')
                ->setParameter('dietaryLevel', $filters['dietaryLevel']);
        }

        if (null !== $filters['maxTime']) {
            $queryBuilder
                ->andWhere('recipe.cookingTimeMinutes <= :maxTime')
                ->setParameter('maxTime', $filters['maxTime']);
        }

        if (null !== $filters['maxCalories']) {
            $queryBuilder
                ->andWhere('recipe.caloriesPerServing <= :maxCalories')
                ->setParameter('maxCalories', $filters['maxCalories']);
        }

        [$sortField, $sortDirection] = match ($filters['sort']) {
            'oldest' => ['recipe.createdAt', 'ASC'],
            'title_asc' => ['recipe.title', 'ASC'],
            'title_desc' => ['recipe.title', 'DESC'],
            'time_asc' => ['recipe.cookingTimeMinutes', 'ASC'],
            'time_desc' => ['recipe.cookingTimeMinutes', 'DESC'],
            'calories_asc' => ['recipe.caloriesPerServing', 'ASC'],
            'calories_desc' => ['recipe.caloriesPerServing', 'DESC'],
            default => ['recipe.createdAt', 'DESC'],
        };

        if (str_starts_with($filters['sort'], 'calories_')) {
            $queryBuilder
                ->addSelect('CASE WHEN recipe.caloriesPerServing IS NULL THEN 1 ELSE 0 END AS HIDDEN caloriesUnknown')
                ->orderBy('caloriesUnknown', 'ASC')
                ->addOrderBy($sortField, $sortDirection);
        } else {
            $queryBuilder->orderBy($sortField, $sortDirection);
        }

        return $queryBuilder
            ->addOrderBy('recipe.id', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
