<?php

namespace App\DataFixtures;

use App\Factory\MarkFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MarkFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        MarkFactory::createMany(10);
    }
}
