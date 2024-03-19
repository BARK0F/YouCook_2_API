<?php

namespace App\Tests\Api\Recipe;

use App\Factory\RecipeFactory;
use App\Tests\Support\ApiTester;

class RecipeDeleteCest
{
    public function userCanDeleteRecipe(ApiTester $I)
    {
        RecipeFactory::createOne();

        $I->sendDelete('/api/recipes/1');

        $I->seeResponseCodeIs(204);
    }
}
