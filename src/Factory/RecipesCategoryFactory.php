<?php

namespace App\Factory;

use App\Entity\RecipesCategory;
use App\Repository\RecipesCategoryRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<RecipesCategory>
 *
 * @method        RecipesCategory|Proxy                     create(array|callable $attributes = [])
 * @method static RecipesCategory|Proxy                     createOne(array $attributes = [])
 * @method static RecipesCategory|Proxy                     find(object|array|mixed $criteria)
 * @method static RecipesCategory|Proxy                     findOrCreate(array $attributes)
 * @method static RecipesCategory|Proxy                     first(string $sortedField = 'id')
 * @method static RecipesCategory|Proxy                     last(string $sortedField = 'id')
 * @method static RecipesCategory|Proxy                     random(array $attributes = [])
 * @method static RecipesCategory|Proxy                     randomOrCreate(array $attributes = [])
 * @method static RecipesCategoryRepository|RepositoryProxy repository()
 * @method static RecipesCategory[]|Proxy[]                 all()
 * @method static RecipesCategory[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static RecipesCategory[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static RecipesCategory[]|Proxy[]                 findBy(array $attributes)
 * @method static RecipesCategory[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static RecipesCategory[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class RecipesCategoryFactory extends ModelFactory
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
            'name' => self::faker()->text(100),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(RecipesCategory $recipesCategory): void {})
        ;
    }

    protected static function getClass(): string
    {
        return RecipesCategory::class;
    }
}
