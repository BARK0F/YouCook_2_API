<?php

namespace App\Tests\Api\Allergen;

use App\Entity\Allergen;
use App\Factory\AllergenFactory;
use App\Tests\Support\ApiTester;

class AllergenGetCollectionCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
        ];
    }

    public function getAllergenCollectionTest(ApiTester $I): void
    {
        $allergen = AllergenFactory::createMany(5);
        $I->sendGet('/api/allergen');

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsACollection(Allergen::class, '/api/allergen', [
            'hydra:member' => 'array',
            'hydra:totalItems' => 'integer',
        ]);
        $I->seeResponseContainsJson([
            'hydra:totalItems' => 5,
        ]);
        $I->seeResponseMatchesJsonType(self::expectedProperties(), '$["hydra:member"][0]');
    }
}
