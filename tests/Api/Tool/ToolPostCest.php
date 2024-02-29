<?php

namespace App\Tests\Api\Tool;

use App\Factory\ToolCategoryFactory;
use App\Tests\Support\ApiTester;

class ToolPostCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
            'toolCategory' => 'string',
        ];
    }

    public function anonymousPostData(ApiTester $I)
    {
        $toolCategory = ToolCategoryFactory::createOne();
        $requestData = [
            'name' => 'toolNameTest',
            'toolCategory' => 'api/tool_categories/'.$toolCategory->getId(),
        ];
        $I->sendPost('api/tools', $requestData);
        $I->seeResponseCodeIs(401);
    }

    public function userPostData(ApiTester $I): void
    {
        /*
         * Les tests seront fonctionnels une fois que l'authentification sera mise en place
        $user = UserFactory::createOne()->object();
        $toolCategory = ToolCategoryFactory::createOne()->object();
        $requestData = [
            'name' => 'toolNameTest',
            'toolCategory' => 'api/tool_categories/'.$toolCategory->getId(),
        ];
        $I->amLoggedInAs($user);
        $I->sendPost('/api/tools', $requestData);
        $I->seeResponseCodeIsSuccessful();
        */
    }
}
