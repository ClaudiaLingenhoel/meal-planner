<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserCrudController extends AbstractCrudController
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher) {}

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstName'),
            TextField::new('lastName'),
            TextField::new('email'),

            TextField::new('plainPassword', 'Password')
                ->setFormType(PasswordType::class)
                ->onlyWhenCreating()
                ->setRequired(true)
                ->setFormTypeOption('constraints', [
                    new NotBlank(message: 'Please enter a password.'),
                    new Length(min: 6, minMessage: 'The password must be at least {{ limit }} characters.'),
                ]),

            AssociationField::new('dietaryType'),

            BooleanField::new('isBlocked')
                ->hideWhenCreating(),

            ChoiceField::new('adminRoles', 'Admin')
                ->setChoices([
                    'Admin' => 'ROLE_ADMIN',
                ])
                ->allowMultipleChoices()
                ->setRequired(false)
                ->setFormTypeOption('expanded', true)
                ->setSortable(false),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof User) {
            $hashedPassword = $this->passwordHasher->hashPassword(
                $entityInstance,
                $entityInstance->getPlainPassword()
            );

            $entityInstance->setPassword($hashedPassword);
        }

        parent::persistEntity($entityManager, $entityInstance);
    }

    public function configureActions(Actions $actions): Actions
    {
        $viewMealPlan = Action::new('viewMealPlan', 'View Meal Plan', 'fas fa-calendar')
            ->linkToRoute(
                'app_meal_planner_admin_view',
                function (User $user): array {
                    return ['id' => $user->getId(),];
                }
            );

        return $actions
            ->add(Crud::PAGE_INDEX, $viewMealPlan)
            ->disable(Action::DELETE);
    }
}