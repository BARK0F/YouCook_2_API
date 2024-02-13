<?php

namespace App\DataFixtures;

use App\Factory\ToolCategoryFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ToolCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $toolCategories = json_decode(file_get_contents(__DIR__.'/data/ToolCategory.json'), true);
        foreach ($toolCategories as $toolCategory) {
            ToolCategoryFactory::createOne($toolCategory);
        }
    }
}
