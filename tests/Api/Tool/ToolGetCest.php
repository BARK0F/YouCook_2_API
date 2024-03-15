<?php

namespace App\Tests\Api\Tool;

use App\Entity\Tool;
use App\Factory\ToolFactory;
use App\Tests\Support\ApiTester;

class ToolGetCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
            'toolCategory' => 'string',
        ];
    }

    public function anonymousGetToolWithIdTest(ApiTester $I): void
    {
        // 1. 'Arrange'
        $data = [
            'name' => 'toolTest',
        ];
        ToolFactory::createOne($data);

        // 2. 'Act'
        $I->sendGet('/api/tools/1');

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(Tool::class, '/api/tools/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), $data);
    }
}
