<?php

namespace App\Tests\Api\User;

use App\Entity\User;
use App\Factory\UserFactory;
use App\Tests\Support\ApiTester;

class UserGetCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'email' => 'string',
            'firstname' => 'string',
            'lastname' => 'string',
            'roles' => 'array',
            'biography' => 'string',
        ];
    }

    public function anonymousCanGetUser(ApiTester $I): void
    {
        $data = [
            'email' => 'test@example.com',
            'firstname' => 'firstname1',
            'lastname' => 'lastname1',
        ];
        UserFactory::createOne($data);

        $I->sendGet('/api/users/1');

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(User::class, '/api/users/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), $data);
    }
}
