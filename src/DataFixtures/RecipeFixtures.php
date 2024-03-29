<?php

namespace App\DataFixtures;

use App\Factory\ConstituteFactory;
use App\Factory\RecipeFactory;
use App\Factory\RecipesCategoryFactory;
use App\Factory\StepFactory;
use App\Factory\ToolFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RecipeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $recipes = json_decode(file_get_contents(__DIR__.'/data/Recipes.json'), true);

        foreach ($recipes as $recipe) {
            RecipeFactory::createOne([
                'name' => $recipe['name'],
                'description' => $recipe['description'],
                'nbPeople' => $recipe['nbPeople'],
                'category' => RecipesCategoryFactory::random(),
                'tools' => ToolFactory::randomRange(1, 3),
                'author' => UserFactory::random(),
            ]);
        }

        RecipeFactory::createMany(5, function (int $i) use ($recipes) {
            return [
                'category' => RecipesCategoryFactory::random(),
                'tools' => ToolFactory::randomRange(1, 3),
                'author' => UserFactory::random(),
                'constitutes' => ConstituteFactory::createMany(5, [
                    'recipe' => RecipeFactory::find(['id' => ($i + count($recipes) - 1)]),
                ]),
                'steps' => StepFactory::createMany(rand(5, 10), [
                    'recipe' => RecipeFactory::find(['id' => ($i + count($recipes) - 1)]),
                ]),
            ];
        });
    }

    public function getDependencies()
    {
        return [
            IngredientFixtures::class,
            RecipesCategoryFixtures::class,
            ToolFixtures::class,
            UserFixtures::class,
        ];
    }
}
