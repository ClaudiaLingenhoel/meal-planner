<?php

namespace App\Tests\Entity;

use App\Entity\RecipeIngredient;
use PHPUnit\Framework\TestCase;

final class RecipeIngredientTest extends TestCase
{
    public function testQuantityCanBeOmittedForUnitsSuchAsToTaste(): void
    {
        $recipeIngredient = (new RecipeIngredient())
            ->setQuantity(null)
            ->setUnit('to taste');

        self::assertNull($recipeIngredient->getQuantity());
        self::assertSame('to taste', $recipeIngredient->getUnit());
    }
}