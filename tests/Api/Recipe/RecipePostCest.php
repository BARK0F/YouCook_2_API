<?php

namespace App\Tests\Api\Recipe;

use App\Entity\Recipe;
use App\Tests\Support\ApiTester;

class RecipePostCest
{
    public static function expectedProperties(): array
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

    public function userCanPostRecipe(ApiTester $I)
    {
        $data = [
            'name' => 'Test name',
            'difficulty' => 'easy',
            'description' => 'lorem ipsum dolor sit amet',
            'nbPeople' => 2,
            'nbDay' => 0,
            'nbHour' => 3,
            'nbMinute' => 45,
        ];

        $I->sendPost('/api/recipes', $data);

        $I->seeResponseCodeIs(201);
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(Recipe::class, '/api/recipes/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), $data);
    }
}
