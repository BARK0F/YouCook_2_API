<?php

namespace App\Tests\Api\User;

use App\Entity\User;
use App\Factory\UserFactory;
use App\Tests\Support\ApiTester;

class UserGetMeCest
{
    protected function expectedProperties(): array
    {
        return [
            'id' => 'intege',
            'email' => 'string',
            'firstname' => 'string',
            'lastname' => 'string',
            'roles' => 'array',
        ];
    }

    public function userCanGetItsProfile(ApiTester $I): void
    {
        $user = UserFactory::createOne()->object();
        $I->amLoggedInAs($user);

        $I->sendGet('/api/me');

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(User::class, '/api/users/1');
    }
}
