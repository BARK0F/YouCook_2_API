<?php

namespace App\Tests\Api\IngredientCategory;

use App\Entity\RecipesCategory;
use App\Factory\IngredientCategoryFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ApiTester;

class IngredientCategoryGetCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
        ];
    }

    public function getIngredientCategoryWithIdTest(ApiTester $I): void
    {
        $user = UserFactory::createOne()->object();
        $data = [
            'name' => 'pates',
        ];
        $ingredientCategory = IngredientCategoryFactory::createOne($data)->object();

        $I->sendGet('/api/ingredients_categories/1');

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(RecipesCategory::class, '/api/ingredients_category/1');
        $I->seeResponseContainsJson(['id' => $ingredientCategory->getId()]);
        $I->seeResponseContainsJson(['name' => $data['name']]);
    }
}
