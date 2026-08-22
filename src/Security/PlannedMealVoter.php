<?php

namespace App\Security;

use App\Entity\PlannedMeal;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Vote;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

final class PlannedMealVoter extends Voter
{
    public const EDIT = 'PLANNED_MEAL_EDIT';
    public const DELETE = 'PLANNED_MEAL_DELETE';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return $subject instanceof PlannedMeal && in_array($attribute, [self::EDIT, self::DELETE], true);
    }

    protected function voteOnAttribute(
        string $attribute,
        mixed $subject,
        TokenInterface $token,
        ?Vote $vote = null,
    ): bool
    {
        $user = $token->getUser();
        if (!$user instanceof User) {
            return false;
        }

        /** @var PlannedMeal $subject */
        $owner = $subject->getUser();

        return null !== $owner && (
            $owner === $user
            || (null !== $owner->getId() && $owner->getId() === $user->getId())
        );
    }
}
