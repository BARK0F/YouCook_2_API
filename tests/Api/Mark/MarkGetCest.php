<?php

namespace App\Tests\Api\Mark;

use App\Entity\Mark;
use App\Factory\MarkFactory;
use App\Factory\RecipeFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ApiTester;

class MarkGetCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'mark' => 'float',
            'user',
            'recipe',
        ];
    }

    public function getMarkWithIdTest(ApiTester $I): void
    {
        $user = UserFactory::createOne()->object();
        $data = [
            'mark' => 2.5,
            'user' => $user,
            'recipe' => RecipeFactory::createOne(['author' => $user])->object(),
        ];
        $mark = MarkFactory::createOne($data)->object();

        $I->sendGet('/api/marks/1');

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(Mark::class, '/api/marks/1');
        $I->seeResponseContainsJson(['id' => $mark->getId()]);
        $I->seeResponseContainsJson(['mark' => $data['mark']]);
    }
}
