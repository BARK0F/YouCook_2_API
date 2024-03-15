<?php

namespace App\Tests\Api\Ingredient;

use App\Entity\Ingredient;
use App\Factory\IngredientFactory;
use App\Tests\Support\ApiTester;

class IngredientGetCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
        ];
    }

    public function getIngredientDetail(ApiTester $I): void
    {
        // 1. 'Arrange'
        $data = [
            'name' => 'fjhy',
        ];
        IngredientFactory::createOne($data);

        // 2. 'Act'
        $I->sendGet('/api/ingredients/1');

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(Ingredient::class, '/api/ingredients/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), $data);
    }
}
