<?php

namespace App\Tests\Api\Ingredient;

use App\Entity\Ingredient;
use App\Factory\IngredientFactory;
use App\Tests\Support\ApiTester;

class IngredientGetCollectionCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
        ];
    }

    public function getCollectionTest(ApiTester $I): void
    {
        IngredientFactory::createMany(5);

        $I->sendGet('/api/ingredients');

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsACollection(Ingredient::class, '/api/ingredients', [
            'hydra:member' => 'array',
            'hydra:totalItems' => 'integer',
        ]);
        $I->seeResponseContainsJson([
            'hydra:totalItems' => 5,
        ]);
        $I->seeResponseMatchesJsonType(self::expectedProperties(), '$["hydra:member"][0]');
    }
}
