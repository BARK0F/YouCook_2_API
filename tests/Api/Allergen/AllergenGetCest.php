<?php

namespace App\Tests\Api\Allergen;

use App\Entity\Allergen;
use App\Factory\AllergenFactory;
use App\Tests\Support\ApiTester;

class AllergenGetCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
        ];
    }

    public function getAllergen(ApiTester $I): void
    {
        $data = [
            'name' => 'testAllergen',
        ];
        $allergen = AllergenFactory::createOne($data);

        $I->sendGet('/api/allergens/1');

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(Allergen::class, '/api/allergens/1');
        $I->seeResponseContainsJson(['id' => $allergen->getId()]);
    }
}
