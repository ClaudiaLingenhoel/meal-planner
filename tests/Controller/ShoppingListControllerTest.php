<?php

namespace App\Tests\Controller;

use App\Controller\ShoppingListController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

final class ShoppingListControllerTest extends TestCase
{
    public function testSelectedDateIsNormalisedToStartOfWeek(): void
    {
        $start = $this->getStartOfWeek(new Request(['week' => '2026-08-21']));

        self::assertSame('2026-08-17', $start->format('Y-m-d'));
    }

    public function testMalformedWeekFallsBackWithoutThrowing(): void
    {
        $start = $this->getStartOfWeek(new Request(['week' => 'not-a-date']));

        self::assertSame('1', $start->format('N'));
    }

    private function getStartOfWeek(Request $request): \DateTimeImmutable
    {
        $method = new \ReflectionMethod(ShoppingListController::class, 'getStartOfWeek');

        return $method->invoke(new ShoppingListController(), $request);
    }
}
