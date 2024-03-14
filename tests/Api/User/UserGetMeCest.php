<?php

namespace App\Tests\Api\User;

use App\Entity\User;
use App\Factory\UserFactory;
use App\Tests\Support\ApiTester;
use Codeception\Util\HttpCode;

class UserGetMeCest
{
    protected function expectedProperties(): array
    {
        return [
            'id' => 'integer',
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
        $I->seeResponseIsAnEntity(User::class, '/api/me');
    }

    public function anonymousCantGetItsProfile(ApiTester $I): void
    {
        UserFactory::createOne();

        $I->sendGet('/api/me');

        $I->seeResponseCodeIs(HttpCode::UNAUTHORIZED);
    }
}
