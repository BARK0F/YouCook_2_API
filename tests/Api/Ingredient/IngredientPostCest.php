<?php

namespace App\Tests\Api\Ingredient;

use App\Factory\IngredientFactory;
use App\Factory\UserFactory;
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

    public function userPostData(ApiTester $I): void
    {
        $user = UserFactory::createOne()->object();
        $requestData = [
            'name' => 'clementineTest',
        ];
        $I->amLoggedInAs($user);
        $I->sendPost('/api/ingredients', $requestData);
        $I->seeResponseCodeIsSuccessful();
    }
}
