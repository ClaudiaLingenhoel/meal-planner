<?php

namespace App\Tests\Entity;

use App\Entity\Recipe;
use PHPUnit\Framework\TestCase;

final class RecipeTest extends TestCase
{
    public function testCaloriesPerServingAreOptional(): void
    {
        $recipe = new Recipe();

        self::assertNull($recipe->getCaloriesPerServing());
        self::assertSame($recipe, $recipe->setCaloriesPerServing(450));
        self::assertSame(450, $recipe->getCaloriesPerServing());
        self::assertNull($recipe->setCaloriesPerServing(null)->getCaloriesPerServing());
    }
}