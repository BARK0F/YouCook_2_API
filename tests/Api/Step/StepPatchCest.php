<?php
declare(strict_types=1);

namespace App\Tests\Api\Step;

use App\Entity\Step;
use App\Factory\StepFactory;
use App\Tests\Support\ApiTester;

class StepPatchCest
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

    public function stepPatchTest(ApiTester $I): void
    {
        StepFactory::createOne();
        $data = [
            'name' => 'stepTest',
        ];

        $I->sendPatch('/api/steps/1', $data);

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(Step::class, '/api/steps/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), $data);
    }

}