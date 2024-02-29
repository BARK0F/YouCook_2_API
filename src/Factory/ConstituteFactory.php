<?php

namespace App\Factory;

use App\Entity\Constitute;
use App\Repository\ConstituteRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Constitute>
 *
 * @method        Constitute|Proxy                     create(array|callable $attributes = [])
 * @method static Constitute|Proxy                     createOne(array $attributes = [])
 * @method static Constitute|Proxy                     find(object|array|mixed $criteria)
 * @method static Constitute|Proxy                     findOrCreate(array $attributes)
 * @method static Constitute|Proxy                     first(string $sortedField = 'id')
 * @method static Constitute|Proxy                     last(string $sortedField = 'id')
 * @method static Constitute|Proxy                     random(array $attributes = [])
 * @method static Constitute|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ConstituteRepository|RepositoryProxy repository()
 * @method static Constitute[]|Proxy[]                 all()
 * @method static Constitute[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Constitute[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Constitute[]|Proxy[]                 findBy(array $attributes)
 * @method static Constitute[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Constitute[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class ConstituteFactory extends ModelFactory
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
            'quantity' => self::faker()->randomFloat(2, 0, 1000),
            'measure' => self::faker()->text(7),
            'recipe' => RecipeFactory::new(),
            'ingredient' => IngredientFactory::new(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(ConstituteFixtures $constitute): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Constitute::class;
    }
}
