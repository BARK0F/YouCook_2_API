<?php

namespace App\Factory;

use App\Entity\IngredientCategory;
use App\Repository\IngredientCategoryRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<IngredientCategory>
 *
 * @method        IngredientCategory|Proxy                     create(array|callable $attributes = [])
 * @method static IngredientCategory|Proxy                     createOne(array $attributes = [])
 * @method static IngredientCategory|Proxy                     find(object|array|mixed $criteria)
 * @method static IngredientCategory|Proxy                     findOrCreate(array $attributes)
 * @method static IngredientCategory|Proxy                     first(string $sortedField = 'id')
 * @method static IngredientCategory|Proxy                     last(string $sortedField = 'id')
 * @method static IngredientCategory|Proxy                     random(array $attributes = [])
 * @method static IngredientCategory|Proxy                     randomOrCreate(array $attributes = [])
 * @method static IngredientCategoryRepository|RepositoryProxy repository()
 * @method static IngredientCategory[]|Proxy[]                 all()
 * @method static IngredientCategory[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static IngredientCategory[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static IngredientCategory[]|Proxy[]                 findBy(array $attributes)
 * @method static IngredientCategory[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static IngredientCategory[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class IngredientCategoryFactory extends ModelFactory
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
            'name' => self::faker()->unique()->word(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(IngredientCategory $ingredientCategory): void {})
        ;
    }

    protected static function getClass(): string
    {
        return IngredientCategory::class;
    }
}
