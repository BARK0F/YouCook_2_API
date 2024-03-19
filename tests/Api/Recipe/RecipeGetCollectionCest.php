<?php

namespace App\Tests\Api\Recipe;

use App\Entity\Recipe;
use App\Factory\RecipeFactory;
use App\Tests\Support\ApiTester;

class RecipeGetCollectionCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
            'difficulty' => 'string',
        ];
    }

    public function userCanGetAllRecipes(ApiTester $I)
    {
        RecipeFactory::createMany(10);

        $I->sendGet('/api/recipes');

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseIsACollection(Recipe::class, '/api/recipes', [
            'hydra:member' => 'array',
            'hydra:totalItems' => 'integer',
        ]);
        $I->seeResponseContainsJson([
            'hydra:totalItems' => 10,
        ]);
        $I->seeResponseMatchesJsonType(self::expectedProperties(), '$["hydra:member"][0]');
    }
}
