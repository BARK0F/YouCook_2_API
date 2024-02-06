<?php

namespace App\Factory;

use App\Entity\ToolCategory;
use App\Repository\ToolCategoryRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<ToolCategory>
 *
 * @method        ToolCategory|Proxy                     create(array|callable $attributes = [])
 * @method static ToolCategory|Proxy                     createOne(array $attributes = [])
 * @method static ToolCategory|Proxy                     find(object|array|mixed $criteria)
 * @method static ToolCategory|Proxy                     findOrCreate(array $attributes)
 * @method static ToolCategory|Proxy                     first(string $sortedField = 'id')
 * @method static ToolCategory|Proxy                     last(string $sortedField = 'id')
 * @method static ToolCategory|Proxy                     random(array $attributes = [])
 * @method static ToolCategory|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ToolCategoryRepository|RepositoryProxy repository()
 * @method static ToolCategory[]|Proxy[]                 all()
 * @method static ToolCategory[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static ToolCategory[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static ToolCategory[]|Proxy[]                 findBy(array $attributes)
 * @method static ToolCategory[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static ToolCategory[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class ToolCategoryFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->word(),
            'description' => 'description par défaut',
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(ToolCategory $toolCategory): void {})
        ;
    }

    protected static function getClass(): string
    {
        return ToolCategory::class;
    }
}
