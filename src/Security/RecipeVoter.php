<?php

namespace App\Security;

use App\Entity\Recipe;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Vote;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

final class RecipeVoter extends Voter
{
    public const EDIT = 'RECIPE_EDIT';
    public const DELETE = 'RECIPE_DELETE';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return $subject instanceof Recipe && in_array($attribute, [self::EDIT, self::DELETE], true);
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

        if (in_array('ROLE_ADMIN', $token->getRoleNames(), true)) {
            return true;
        }

        /** @var Recipe $subject */
        $creator = $subject->getCreator();

        return null !== $creator && (
            $creator === $user
            || (null !== $creator->getId() && $creator->getId() === $user->getId())
        );
    }
}
