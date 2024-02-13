<?php

namespace App\DataFixtures;

use App\Factory\StepFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StepFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        StepFactory::createMany(5);
    }
}
