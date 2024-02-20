<?php

namespace App\DataFixtures;

use App\Factory\AllergenFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AllergenFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $allergens = json_decode(file_get_contents(__DIR__.'/data/Allergen.json'), true);

        foreach ($allergens as $allergen) {
            AllergenFactory::createOne(['name' => $allergen['name']]);
        }
    }
}
