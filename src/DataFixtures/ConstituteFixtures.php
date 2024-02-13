<?php

namespace App\DataFixtures;

use App\Factory\ConstituteFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ConstituteFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $measures = json_decode(file_get_contents(__DIR__.'/data/Measure.json'), true);

        foreach ($measures as $measure) {
            ConstituteFactory::createOne([
                'measure' => $measure['measure'],
            ]);
        }
    }

    public function getDependencies(): array
    {
        return [
            RecipeFixtures::class,
            IngredientFixtures::class,
        ];
    }
}
