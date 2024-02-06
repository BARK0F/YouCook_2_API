<?php

namespace App\DataFixtures;

use App\Factory\IngredientFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class IngredientFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $ingredients = json_decode(file_get_contents(__DIR__.'/data/Ingredients.json'), true);

        foreach ($ingredients as $ingredient) {
            IngredientFactory::createOne(['name' => $ingredient['name']]);
        }
    }

    public function getDependencies(): array
    {
        return [
            IngredientCategoryFixtures::class,
        ];
    }
}
