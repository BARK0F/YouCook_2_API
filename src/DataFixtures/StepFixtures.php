<?php

namespace App\DataFixtures;

use App\Factory\StepFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class StepFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        StepFactory::createMany(10);
    }

    public function getDependencies()
    {
        return [RecipeFixtures::class];
    }
}
