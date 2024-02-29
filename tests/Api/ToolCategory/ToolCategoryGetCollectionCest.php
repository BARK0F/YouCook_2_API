<?php

namespace App\Tests\Api\ToolCategory;

use App\Entity\ToolCategory;
use App\Factory\ToolCategoryFactory;
use App\Tests\Support\ApiTester;

class ToolCategoryGetCollectionCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
            'tools' => 'array',
        ];
    }

    public function getToolCollectionTest(ApiTester $I): void
    {
        ToolCategoryFactory::createMany(5);

        $I->sendGet('/api/tool_categories');

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsACollection(ToolCategory::class, '/api/tool_categories', [
            'hydra:member' => 'array',
            'hydra:totalItems' => 'integer',
        ]);
        $I->seeResponseContainsJson([
            'hydra:totalItems' => 5,
        ]);
        $I->seeResponseMatchesJsonType(self::expectedProperties(), '$["hydra:member"][0]');
    }
}
