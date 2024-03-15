<?php

namespace App\Tests\Api\Tool;

use App\Entity\Tool;
use App\Factory\ToolFactory;
use App\Tests\Support\ApiTester;

class ToolGetCollectionCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
            'toolCategory' => 'string',
        ];
    }

    public function getToolCollectionTest(ApiTester $I): void
    {
        ToolFactory::createMany(5);

        $I->sendGet('/api/tools');

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsACollection(Tool::class, '/api/tools', [
            'hydra:member' => 'array',
            'hydra:totalItems' => 'integer',
        ]);
        $I->seeResponseContainsJson([
            'hydra:totalItems' => 5,
        ]);
        $I->seeResponseMatchesJsonType(self::expectedProperties(), '$["hydra:member"][0]');
    }
}
