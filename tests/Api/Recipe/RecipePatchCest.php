<?php

namespace App\Tests\Api\Recipe;

use App\Entity\Recipe;
use App\Factory\RecipeFactory;
use App\Tests\Support\ApiTester;

class RecipePatchCest
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

    public function userCanPatchRecipe(ApiTester $I)
    {
        RecipeFactory::createOne();

        $dataPatch = [
            'name' => 'Super poulet rôti!',
            'difficulty' => 'hard',
        ];

        $I->sendPatch('/api/recipes/1', $dataPatch);

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(Recipe::class, '/api/recipes/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), $dataPatch);
    }
}
