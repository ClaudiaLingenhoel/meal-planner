<?php

namespace App\Repository;

use App\Entity\PlannedMeal;
use App\Entity\User;
use DateTimeInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlannedMeal>
 */
class PlannedMealRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlannedMeal::class);
    }

    public function findForUserAndWeek(User $user, DateTimeInterface $start, DateTimeInterface $end): array
    {
        return $this->createQueryBuilder('plannedMeal')
            ->addSelect('recipe')
            ->join('plannedMeal.recipe', 'recipe')
            ->andWhere('plannedMeal.user = :user')
            ->andWhere('plannedMeal.scheduledFor BETWEEN :start AND :end')
            ->setParameter('user', $user)
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->orderBy('plannedMeal.scheduledFor', 'ASC')
            ->addOrderBy('plannedMeal.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /** @return list<PlannedMeal> */
    public function findForUserAndWeekWithIngredients(User $user, DateTimeInterface $start, DateTimeInterface $end): array
    {
        return $this->createQueryBuilder('plannedMeal')
            ->addSelect('recipe', 'recipeIngredient', 'ingredient')
            ->join('plannedMeal.recipe', 'recipe')
            ->leftJoin('recipe.recipeIngredients', 'recipeIngredient')
            ->leftJoin('recipeIngredient.ingredient', 'ingredient')
            ->andWhere('plannedMeal.user = :user')
            ->andWhere('plannedMeal.scheduledFor BETWEEN :start AND :end')
            ->setParameter('user', $user)
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->orderBy('plannedMeal.scheduledFor', 'ASC')
            ->addOrderBy('plannedMeal.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}
