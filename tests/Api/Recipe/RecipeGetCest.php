<?php

namespace App\Tests\Api\Recipe;

use App\Entity\Recipe;
use App\Factory\RecipeFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ApiTester;

class RecipeGetCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
            'difficulty' => 'string',
            'description' => 'string',
            'nbPeople' => 'integer',
            'nbDay' => 'integer',
            'nbHour' => 'integer',
            'nbMinute' => 'integer',
        ];
    }

    public function userCanFetchAllRecipes(ApiTester $I)
    {
        $user = UserFactory::createOne()->object();

        $data = [
            'name' => 'Couscous',
            'difficulty' => 'medium',
            'description' => 'Un magnifique couscous de test',
            'nbPeople' => 2,
            'nbDay' => 0,
            'nbHour' => 3,
            'nbMinute' => 45,
        ];

        RecipeFactory::createOne($data);

        $I->sendGet('/api/recipes/1');

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(Recipe::class, '/api/recipes/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), $data);
    }
}
