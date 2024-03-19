<?php

namespace App\Tests\Api\RecipesCategory;

use App\Entity\RecipesCategory;
use App\Factory\RecipesCategoryFactory;
use App\Factory\RecipeFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ApiTester;

class RecipesCategoryGetCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
            'recipes' => 'array',
        ];
    }

    public function getRecipesCategoryWithIdTest(ApiTester $I): void
    {
        $user = UserFactory::createOne()->object();
        $data = [
            'name' => 'plat',
            'recipes' => RecipeFactory::createMany(5, ['author' => UserFactory::new()]),
        ];
        $recipeCategory = RecipesCategoryFactory::createOne($data)->object();

        $I->sendGet('/api/recipes_categories/1');

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(RecipesCategory::class, '/api/recipes_categories/1');
        $I->seeResponseContainsJson(['id' => $recipeCategory->getId()]);
        $I->seeResponseContainsJson(['name' => $data['name']]);
    }

}
