<?php

namespace App\Tests\Api\User;

use App\Entity\User;
use App\Factory\UserFactory;
use App\Tests\Support\ApiTester;

class UserGetCest
{
    protected static function expectedPropertiesBiographyNotNull(): array
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

    protected static function expectedPropertiesWithoutBiography(): array
    {
        return [
            'id' => 'integer',
            'email' => 'string',
            'firstname' => 'string',
            'lastname' => 'string',
            'roles' => 'array',
        ];
    }

    public function anonymousCanGetUserWithItsBiography(ApiTester $I): void
    {
        $data = [
            'email' => 'test@example.com',
            'firstname' => 'firstname1',
            'lastname' => 'lastname1',
            'biography' => 'Test',
        ];
        UserFactory::createOne($data);

        $I->sendGet('/api/users/1');

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(User::class, '/api/users/1');
        $I->seeResponseIsAnItem(self::expectedPropertiesBiographyNotNull(), $data);
    }

    public function anonymousCanGetUserWithoutBiography(ApiTester $I): void
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
        $I->seeResponseIsAnItem(self::expectedPropertiesWithoutBiography(), $data);
    }
}
