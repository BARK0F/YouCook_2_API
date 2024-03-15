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
            'name' => 'clementine',
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

    public function IngredientList(ApiTester $I): void
    {
        IngredientFactory::createSequence([
            ['name' => 'clementine'],
            ['name' => 'clement'],
        ]);

        $I->sendGet('/api/ingredients');
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['hydra:member' => [
            [
                'name' => 'clement',
                '@id' => '/api/ingredients/2',
                '@type' => 'Ingredient',
                'id' => 2,
                'constitutes' => [],
            ],
            [
                'name' => 'clementine',
                '@id' => '/api/ingredients/1',
                '@type' => 'Ingredient',
                'id' => 1,
                'constitutes' => [],
            ],
        ]]);
    }
}
