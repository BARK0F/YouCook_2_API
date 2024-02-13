<?php

namespace App\DataFixtures;

use App\Factory\IngredientCategoryFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class IngredientCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $ingredientCategories = json_decode(file_get_contents(__DIR__.'/data/IngredientCategories.json'), true);

        foreach ($ingredientCategories as $category) {
            IngredientCategoryFactory::createOne(['name' => $category['name']]);
        }
    }
}