<?php

namespace App\Entity;

use App\Enum\MealTime;
use App\Repository\PlannedMealRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PlannedMealRepository::class)]
#[ORM\UniqueConstraint(
    name: 'unique_planned_meal',
    fields: ['user', 'recipe', 'scheduledFor', 'mealTime']
)]
#[UniqueEntity(
    fields: ['user', 'recipe', 'scheduledFor', 'mealTime'],
    message: 'This recipe is already planned for this meal.',
    errorPath: 'mealTime'
)]
class PlannedMeal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'plannedMeals')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'plannedMeals')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull]
    private ?Recipe $recipe = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank]
    private ?\DateTime $scheduledFor = null;

    #[ORM\Column(enumType: MealTime::class)]
    #[Assert\NotNull]
    private ?MealTime $mealTime = null;

    #[ORM\Column]
    #[Assert\NotNull]
    #[Assert\Range(min: 1, max: 100)]
    private ?int $servings = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): static
    {
        $this->recipe = $recipe;

        return $this;
    }

    public function getScheduledFor(): ?\DateTime
    {
        return $this->scheduledFor;
    }

    public function setScheduledFor(\DateTime $scheduledFor): static
    {
        $this->scheduledFor = $scheduledFor;

        return $this;
    }

    public function getScheduledForDisplay(): string
    {
        return $this->scheduledFor?->format('Y-m-d') ?? '';
    }

    public function getMealTime(): ?MealTime
    {
        return $this->mealTime;
    }

    public function setMealTime(MealTime $mealTime): static
    {
        $this->mealTime = $mealTime;

        return $this;
    }

    public function getServings(): ?int
    {
        return $this->servings;
    }

    public function setServings(int $servings): static
    {
        $this->servings = $servings;

        return $this;
    }
}
