<?php

namespace App\Tests\Api\Ingredient;

use App\Factory\IngredientFactory;
use App\Tests\Support\ApiTester;

class IngredientPostCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
        ];
    }

    public function anonymousPostData(ApiTester $I)
    {
        $toolCategory = IngredientFactory::createOne();
        $requestData = [
            'name' => 'toolNameTest',
        ];
        $I->sendPost('api/ingredients', $requestData);
        $I->seeResponseCodeIs(401);
    }
}
