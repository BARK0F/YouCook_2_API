<?php

namespace App\DataFixtures;

use App\Factory\RecipesCategoryFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RecipesCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $category = json_decode(file_get_contents(__DIR__.'/data/RecipesCategory.json'), true);
        foreach ($category as $name) {
            RecipesCategoryFactory::createOne($name);
        }
    }
}
