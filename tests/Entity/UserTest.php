<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    public function testAdminRoleCanBeChangedWithoutRemovingUserAccess(): void
    {
        $user = new User();

        self::assertSame(['ROLE_USER'], $user->getRoles());
        self::assertFalse($user->isAdmin());

        $user->setAdmin(true);
        self::assertTrue($user->isAdmin());
        self::assertContains('ROLE_ADMIN', $user->getRoles());
        self::assertContains('ROLE_USER', $user->getRoles());
        self::assertSame(['ROLE_ADMIN'], $user->getAdminRoles());

        $user->setAdminRoles([]);
        self::assertFalse($user->isAdmin());
        self::assertSame(['ROLE_USER'], $user->getRoles());
        self::assertSame([], $user->getAdminRoles());
    }

    public function testSessionUserRemainsEqualWhenAccountIsUnchanged(): void
    {
        $sessionUser = $this->createUser();
        $sessionUser = unserialize(serialize($sessionUser));

        self::assertTrue($sessionUser->isEqualTo($this->createUser()));
    }

    public function testSessionUserChangesWhenAccountIsBlocked(): void
    {
        $sessionUser = $this->createUser();
        $sessionUser = unserialize(serialize($sessionUser));
        $refreshedUser = $this->createUser()->setIsBlocked(true);

        self::assertFalse($sessionUser->isEqualTo($refreshedUser));
    }

    public function testBlockedSessionIsNeverConsideredValid(): void
    {
        $sessionUser = $this->createUser()->setIsBlocked(true);
        $refreshedUser = $this->createUser()->setIsBlocked(true);

        self::assertFalse($sessionUser->isEqualTo($refreshedUser));
    }

    private function createUser(): User
    {
        return (new User())
            ->setEmail('user@example.com')
            ->setPassword('hashed-password')
            ->setFirstName('Test')
            ->setLastName('User');
    }
}