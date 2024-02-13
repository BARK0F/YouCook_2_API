<?php

namespace App\DataFixtures;

use App\Factory\MarkFactory;
use App\Factory\RecipeFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MarkFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        MarkFactory::createMany(10, function () {
            return [
                'user' => UserFactory::random(),
                'recipe' => RecipeFactory::random(),
            ];
        });
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            RecipeFixtures::class,
        ];
    }
}
