<?php

namespace App\Tests\Api\RecipesCategory;

use App\Entity\RecipesCategory;
use App\Factory\RecipesCategoryFactory;
use App\Factory\RecipeFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ApiTester;

class RecipesCategoryGetCollectionCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
            'recipes' => 'array',
        ];
    }

    public function getRecipesCategoryCollectionTest(ApiTester $I): void
    {
        $recipesCategories = RecipesCategoryFactory::createMany(5);
        $I->sendGet('/api/recipes_categories');

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsACollection(RecipesCategory::class, '/api/recipes_categories', [
            'hydra:member' => 'array',
            'hydra:totalItems' => 'integer',
        ]);
        $I->seeResponseContainsJson([
            'hydra:totalItems' => 5,
        ]);
        $I->seeResponseMatchesJsonType(self::expectedProperties(), '$["hydra:member"][0]');
    }

}
