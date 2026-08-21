<?php

namespace App\Tests\Controller;

use App\Controller\RecipeController;
use App\Entity\DietaryType;
use App\Repository\DietaryTypeRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

final class RecipeControllerTest extends TestCase
{
    public function testValidBrowserFiltersAreNormalised(): void
    {
        $dietaryType = (new DietaryType())
            ->setName('Vegetarian')
            ->setRestrictionLevel(2);
        (new \ReflectionProperty(DietaryType::class, 'id'))->setValue($dietaryType, 2);

        $repository = $this->createMock(DietaryTypeRepository::class);
        $repository->expects(self::once())
            ->method('find')
            ->with(2)
            ->willReturn($dietaryType);

        $filters = $this->filtersFromRequest(new Request([
            'search' => '  rice  ',
            'dietaryType' => '2',
            'maxTime' => '45',
            'maxCalories' => '600',
            'sort' => 'time_asc',
        ]), $repository);

        self::assertSame('rice', $filters['search']);
        self::assertSame(2, $filters['dietaryType']);
        self::assertSame(2, $filters['dietaryLevel']);
        self::assertSame(45, $filters['maxTime']);
        self::assertSame(600, $filters['maxCalories']);
        self::assertSame('time_asc', $filters['sort']);
    }

    public function testInvalidAndEmptyFiltersFallBackSafely(): void
    {
        $defaultDietaryType = (new DietaryType())
            ->setName('Vegetarian')
            ->setRestrictionLevel(2);
        (new \ReflectionProperty(DietaryType::class, 'id'))->setValue($defaultDietaryType, 2);

        $repository = $this->createMock(DietaryTypeRepository::class);
        $repository->expects(self::never())->method('find');

        $filters = $this->filtersFromRequest(new Request([
            'dietaryType' => '',
            'maxTime' => 'invalid',
            'maxCalories' => '-10',
            'sort' => 'not-a-sort',
        ]), $repository, $defaultDietaryType);

        self::assertNull($filters['dietaryType']);
        self::assertNull($filters['dietaryLevel']);
        self::assertNull($filters['maxTime']);
        self::assertNull($filters['maxCalories']);
        self::assertSame('newest', $filters['sort']);
    }

    public function testUserDietaryTypeIsUsedWhenTheFilterIsOmitted(): void
    {
        $defaultDietaryType = (new DietaryType())
            ->setName('Vegetarian')
            ->setRestrictionLevel(2);
        (new \ReflectionProperty(DietaryType::class, 'id'))->setValue($defaultDietaryType, 2);

        $repository = $this->createMock(DietaryTypeRepository::class);
        $repository->expects(self::never())->method('find');

        $filters = $this->filtersFromRequest(new Request(), $repository, $defaultDietaryType);

        self::assertSame(2, $filters['dietaryType']);
        self::assertSame(2, $filters['dietaryLevel']);
    }

    /** @return array<string, string|int|null> */
    private function filtersFromRequest(
        Request $request,
        DietaryTypeRepository $repository,
        ?DietaryType $defaultDietaryType = null,
    ): array
    {
        $method = new \ReflectionMethod(RecipeController::class, 'filtersFromRequest');

        return $method->invoke(new RecipeController(), $request, $repository, $defaultDietaryType);
    }
}