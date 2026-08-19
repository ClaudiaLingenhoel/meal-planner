<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    private ?string $title = null;

    #[ORM\Column]
    #[Assert\NotNull]
    #[Assert\Positive]
    private ?int $cookingTimeMinutes = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\Length(max: 1000)]
    private ?string $shortDescription = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 10)]
    private ?string $instructions = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $source = null;

    #[ORM\Column]
    #[Assert\NotNull]
    #[Assert\Positive]
    private ?int $servings = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column]
    private ?\DateTime $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'recipes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?DietaryType $dietaryType = null;

    /**
     * @var Collection<int, RecipeIngredient>
     */
    #[ORM\OneToMany(targetEntity: RecipeIngredient::class, mappedBy: 'recipe', cascade: ['persist'], orphanRemoval: true)]
    private Collection $recipeIngredients;

    /**
     * @var Collection<int, PlannedMeal>
     */
    #[ORM\OneToMany(targetEntity: PlannedMeal::class, mappedBy: 'recipe', orphanRemoval: true)]
    private Collection $plannedMeals;

    #[ORM\ManyToOne(inversedBy: 'recipes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $creator = null;

    public function __construct()
    {
        $this->recipeIngredients = new ArrayCollection();
        $this->plannedMeals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getCookingTimeMinutes(): ?int
    {
        return $this->cookingTimeMinutes;
    }

    public function setCookingTimeMinutes(int $cookingTimeMinutes): static
    {
        $this->cookingTimeMinutes = $cookingTimeMinutes;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): static
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getInstructions(): ?string
    {
        return $this->instructions;
    }

    public function setInstructions(string $instructions): static
    {
        $this->instructions = $instructions;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(?string $source): static
    {
        $this->source = $source;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTime $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDietaryType(): ?DietaryType
    {
        return $this->dietaryType;
    }

    public function setDietaryType(?DietaryType $dietaryType): static
    {
        $this->dietaryType = $dietaryType;

        return $this;
    }

    /**
     * @return Collection<int, RecipeIngredient>
     */
    public function getRecipeIngredients(): Collection
    {
        return $this->recipeIngredients;
    }

    public function addRecipeIngredient(RecipeIngredient $recipeIngredient): static
    {
        if (!$this->recipeIngredients->contains($recipeIngredient)) {
            $this->recipeIngredients->add($recipeIngredient);
            $recipeIngredient->setRecipe($this);
        }

        return $this;
    }

    public function removeRecipeIngredient(RecipeIngredient $recipeIngredient): static
    {
        if ($this->recipeIngredients->removeElement($recipeIngredient)) {
            // set the owning side to null (unless already changed)
            if ($recipeIngredient->getRecipe() === $this) {
                $recipeIngredient->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PlannedMeal>
     */
    public function getPlannedMeals(): Collection
    {
        return $this->plannedMeals;
    }

    public function addPlannedMeal(PlannedMeal $plannedMeal): static
    {
        if (!$this->plannedMeals->contains($plannedMeal)) {
            $this->plannedMeals->add($plannedMeal);
            $plannedMeal->setRecipe($this);
        }

        return $this;
    }

    public function removePlannedMeal(PlannedMeal $plannedMeal): static
    {
        if ($this->plannedMeals->removeElement($plannedMeal)) {
            // set the owning side to null (unless already changed)
            if ($plannedMeal->getRecipe() === $this) {
                $plannedMeal->setRecipe(null);
            }
        }

        return $this;
    }

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): static
    {
        $this->creator = $creator;

        return $this;
    }
}
