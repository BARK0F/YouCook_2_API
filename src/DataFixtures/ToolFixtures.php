<?php

namespace App\DataFixtures;

use App\Factory\ToolCategoryFactory;
use App\Factory\ToolFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ToolFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $tools = json_decode(file_get_contents(__DIR__.'/data/Tool.json'), true);
        foreach ($tools as $tool) {
            ToolFactory::createOne([
                'name' => $tool['name'],
                'toolCategory' => ToolCategoryFactory::findOrCreate([
                    'name' => $tool['toolCategory'],
                ])]
            );
        }
    }

    public function getDependencies(): array
    {
        return [ToolCategoryFixtures::class];
    }
}
