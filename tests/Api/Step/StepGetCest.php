<?php

namespace App\Tests\Api\Step;

use App\Entity\Step;
use App\Factory\StepFactory;
use App\Tests\Support\ApiTester;

class StepGetCest
{
    protected static function expectedProperties():array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
            'description' => 'string',
            'recipe' => 'array',
        ];
    }

    public function anonymousGetStepWithIdTest(ApiTester $I): void
    {
        // 1. 'Arrange'
        $data = [
            'name' => 'stepTest',
        ];
        StepFactory::createOne($data);

        // 2. 'Act'
        $I->sendGet('/api/steps/1');

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(Step::class, '/api/steps/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), $data);
    }

}
