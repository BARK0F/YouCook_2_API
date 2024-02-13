<?php

namespace App\DataFixtures;

use App\Factory\AllergenFactory;
use App\Factory\StoreFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne([
            'email' => 'root@example.com',
            'firstname' => 'Thibault',
            'lastname' => 'Minneboo',
            'roles' => ['ROLE_ADMIN'],
            'allergens' => AllergenFactory::randomRange(1, 3),
        ]);
        UserFactory::createMany(20, function () {
            return [
                'allergens' => AllergenFactory::randomRange(1, 3),
            ];
        });
    }

    public function getDependencies()
    {
        return [
            AllergenFixtures::class,
        ];
    }
}
