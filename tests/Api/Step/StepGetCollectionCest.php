<?php

namespace App\Tests\Api\Step;

use App\Entity\Step;
use App\Factory\StepFactory;
use App\Tests\Support\ApiTester;

class StepGetCollectionCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
            'description' => 'string',
            'recipe' => 'array',
        ];
    }

    public function getStepCollectionTest(ApiTester $I): void
    {
        StepFactory::createMany(5);

        $I->sendGet('/api/steps');

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsACollection(Step::class, '/api/steps', [
            'hydra:member' => 'array',
            'hydra:totalItems' => 'integer',
        ]);
        $I->seeResponseContainsJson([
            'hydra:totalItems' => 5,
        ]);
        $I->seeResponseMatchesJsonType(self::expectedProperties(), '$["hydra:member"][0]');
    }
}
