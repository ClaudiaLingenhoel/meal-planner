<?php

namespace App\Tests\Security;

use App\Entity\User;
use App\Security\UserChecker;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;

final class UserCheckerTest extends TestCase
{
    public function testBlockedUserCannotAuthenticate(): void
    {
        $this->expectException(CustomUserMessageAccountStatusException::class);
        $this->expectExceptionMessage('Your account has been blocked.');

        (new UserChecker())->checkPreAuth((new User())->setIsBlocked(true));
    }

    public function testActiveUserCanAuthenticate(): void
    {
        (new UserChecker())->checkPreAuth(new User());

        self::addToAssertionCount(1);
    }
}