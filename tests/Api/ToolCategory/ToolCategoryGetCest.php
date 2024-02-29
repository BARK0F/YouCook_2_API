<?php

namespace App\Tests\Api\ToolCategory;

use App\Entity\ToolCategory;
use App\Factory\ToolCategoryFactory;
use App\Tests\Support\ApiTester;

class ToolCategoryGetCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
            'tools' => 'array',
        ];
    }

    public function anonymousGetToolWithIdTest(ApiTester $I): void
    {
        // 1. 'Arrange'
        $data = [
            'name' => 'toolCategoryTest',
        ];
        ToolCategoryFactory::createOne($data);

        // 2. 'Act'
        $I->sendGet('/api/tool_categories/1');

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(ToolCategory::class, '/api/tool_categories/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), $data);
    }
}
