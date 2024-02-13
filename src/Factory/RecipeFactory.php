<?php

namespace App\Factory;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Recipe>
 *
 * @method        Recipe|Proxy                     create(array|callable $attributes = [])
 * @method static Recipe|Proxy                     createOne(array $attributes = [])
 * @method static Recipe|Proxy                     find(object|array|mixed $criteria)
 * @method static Recipe|Proxy                     findOrCreate(array $attributes)
 * @method static Recipe|Proxy                     first(string $sortedField = 'id')
 * @method static Recipe|Proxy                     last(string $sortedField = 'id')
 * @method static Recipe|Proxy                     random(array $attributes = [])
 * @method static Recipe|Proxy                     randomOrCreate(array $attributes = [])
 * @method static RecipeRepository|RepositoryProxy repository()
 * @method static Recipe[]|Proxy[]                 all()
 * @method static Recipe[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Recipe[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Recipe[]|Proxy[]                 findBy(array $attributes)
 * @method static Recipe[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Recipe[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class RecipeFactory extends ModelFactory
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
        $difficulties = ['easy', 'medium', 'hard'];

        return [
            'name' => self::faker()->words(5, true),
            'description' => self::faker()->paragraphs(3, true),
            'difficulty' => $difficulties[array_rand($difficulties)],
            'nbDay' => self::faker()->numberBetween(0, 10),
            'nbHour' => self::faker()->numberBetween(0, 23),
            'nbMinute' => self::faker()->numberBetween(0, 59),
            'nbPeople' => self::faker()->numberBetween(2, 10),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Recipe $recipe): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Recipe::class;
    }
}
