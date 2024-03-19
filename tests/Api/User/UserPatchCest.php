<?php

namespace App\Tests\Api\User;

use App\Entity\User;
use App\Factory\UserFactory;
use App\Tests\Support\ApiTester;
use Codeception\Util\HttpCode;

class UserPatchCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'email' => 'string',
            'firstname' => 'string',
            'lastname' => 'string',
            'roles' => 'array',
        ];
    }

    public function anonymousCantPatchUser(ApiTester $I)
    {
        UserFactory::createOne();

        $I->sendPatch('/api/users/1');

        $I->seeResponseCodeIs(HttpCode::UNAUTHORIZED);
    }

    public function authenticateUserCantPatchOtherUser(ApiTester $I)
    {
        /** @var User $user */
        $user = UserFactory::createOne()->object();
        UserFactory::createOne();

        $I->amLoggedInAs($user);

        $I->sendPatch('/api/users/2');

        $I->seeResponseCodeIs(HttpCode::FORBIDDEN);
    }

    public function authenticateUserCanPatchHisUser(ApiTester $I)
    {
        $dataInit = [
            'lastname' => 'lastname1',
            'firstname' => 'firstname1',
            'email' => 'test1@example.com',
        ];

        /** @var User $user */
        $user = UserFactory::createOne()->object();

        $I->amLoggedInAs($user);

        $dataPatch = [
            'lastname' => 'lastname2',
            'firstname' => 'firstname2',
            'email' => 'test2@example.com',
        ];

        $I->sendPatch('/api/users/1', $dataPatch);

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(User::class, '/api/users/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), $dataPatch);
    }
}
