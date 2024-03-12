<?php

namespace App\Tests\Api\Mark;

use App\Entity\Mark;
use App\Factory\MarkFactory;
use App\Factory\RecipeFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ApiTester;

class MarkGetCollectionCest
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

    public function getMarkCollectionTest(ApiTester $I): void
    {
        $users = UserFactory::createMany(5);

        foreach ($users as $user) {
            $recipe = RecipeFactory::createOne(['author' => $user]);
            MarkFactory::createOne(['user' => $user, 'recipe' => $recipe]);
        }
        $I->sendGet('/api/marks');

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsACollection(Mark::class, '/api/marks', [
            'hydra:member' => 'array',
            'hydra:totalItems' => 'integer',
        ]);
        $I->seeResponseContainsJson([
            'hydra:totalItems' => 5,
        ]);
        $I->seeResponseMatchesJsonType(self::expectedProperties(), '$["hydra:member"][0]');
    }
}
