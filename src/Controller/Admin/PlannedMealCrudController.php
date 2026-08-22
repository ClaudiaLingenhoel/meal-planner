<?php

namespace App\Controller\Admin;

use App\Entity\PlannedMeal;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;

class PlannedMealCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PlannedMeal::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('user'),
            AssociationField::new('recipe'),
            TextField::new('scheduledForDisplay', 'Scheduled For'),
            ChoiceField::new('mealTime'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable(
                Action::NEW,
                Action::EDIT,
                Action::DELETE
            );
    }
}
