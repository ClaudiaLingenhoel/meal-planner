<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface, EquatableInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[Assert\Email]
    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    // Not stored in the database
    private ?string $plainPassword = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    private ?string $lastName = null;

    #[ORM\Column]
    private ?bool $isBlocked = false;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?DietaryType $dietaryType = null;

    /**
     * @var Collection<int, PlannedMeal>
     */
    #[ORM\OneToMany(targetEntity: PlannedMeal::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $plannedMeals;

    /**
     * @var Collection<int, Recipe>
     */
    #[ORM\OneToMany(targetEntity: Recipe::class, mappedBy: 'creator')]
    private Collection $recipes;

    public function __construct()
    {
        $this->plannedMeals = new ArrayCollection();
        $this->recipes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function isAdmin(): bool
    {
        return in_array('ROLE_ADMIN', $this->roles, true);
    }

    public function setAdmin(bool $admin): static
    {
        if ($admin && !$this->isAdmin()) {
            $this->roles[] = 'ROLE_ADMIN';
        } elseif (!$admin) {
            $this->roles = array_values(array_filter(
                $this->roles,
                static fn (string $role): bool => 'ROLE_ADMIN' !== $role,
            ));
        }

        return $this;
    }

    /** @return list<string> */
    public function getAdminRoles(): array
    {
        return $this->isAdmin() ? ['ROLE_ADMIN'] : [];
    }

    /** @param list<string> $roles */
    public function setAdminRoles(array $roles): static
    {
        return $this->setAdmin(in_array('ROLE_ADMIN', $roles, true));
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): static
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * Ensure the session doesn't contain actual password hashes by CRC32C-hashing them, as supported since Symfony 7.3.
     */
    public function __serialize(): array
    {
        $data = (array) $this;
        $data["\0" . self::class . "\0password"] = hash('crc32c', $this->password);

        return $data;
    }

    public function isEqualTo(UserInterface $user): bool
    {
        if (!$user instanceof self || $this->isBlocked() || $user->isBlocked()) {
            return false;
        }

        if ($this->getUserIdentifier() !== $user->getUserIdentifier()) {
            return false;
        }

        $currentPassword = $this->getPassword();
        $refreshedPassword = $user->getPassword();
        if (
            $currentPassword !== $refreshedPassword
            && (8 !== strlen((string) $currentPassword) || hash('crc32c', (string) $refreshedPassword) !== $currentPassword)
        ) {
            return false;
        }

        $currentRoles = $this->getRoles();
        $refreshedRoles = $user->getRoles();
        sort($currentRoles);
        sort($refreshedRoles);

        return $currentRoles === $refreshedRoles;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function isBlocked(): ?bool
    {
        return $this->isBlocked;
    }

    public function setIsBlocked(bool $isBlocked): static
    {
        $this->isBlocked = $isBlocked;

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
            $plannedMeal->setUser($this);
        }

        return $this;
    }

    public function removePlannedMeal(PlannedMeal $plannedMeal): static
    {
        if ($this->plannedMeals->removeElement($plannedMeal)) {
            // set the owning side to null (unless already changed)
            if ($plannedMeal->getUser() === $this) {
                $plannedMeal->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Recipe>
     */
    public function getRecipes(): Collection
    {
        return $this->recipes;
    }

    public function addRecipe(Recipe $recipe): static
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes->add($recipe);
            $recipe->setCreator($this);
        }

        return $this;
    }

    public function removeRecipe(Recipe $recipe): static
    {
        if ($this->recipes->removeElement($recipe)) {
            // set the owning side to null (unless already changed)
            if ($recipe->getCreator() === $this) {
                $recipe->setCreator(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->email;
    }
}