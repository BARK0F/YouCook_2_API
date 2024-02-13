<?php

namespace App\Factory;

use App\Entity\Mark;
use App\Repository\MarkRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Mark>
 *
 * @method        Mark|Proxy                     create(array|callable $attributes = [])
 * @method static Mark|Proxy                     createOne(array $attributes = [])
 * @method static Mark|Proxy                     find(object|array|mixed $criteria)
 * @method static Mark|Proxy                     findOrCreate(array $attributes)
 * @method static Mark|Proxy                     first(string $sortedField = 'id')
 * @method static Mark|Proxy                     last(string $sortedField = 'id')
 * @method static Mark|Proxy                     random(array $attributes = [])
 * @method static Mark|Proxy                     randomOrCreate(array $attributes = [])
 * @method static MarkRepository|RepositoryProxy repository()
 * @method static Mark[]|Proxy[]                 all()
 * @method static Mark[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Mark[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Mark[]|Proxy[]                 findBy(array $attributes)
 * @method static Mark[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Mark[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class MarkFactory extends ModelFactory
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
            'mark' => self::faker()->randomFloat(2, 0, 5),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Mark $mark): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Mark::class;
    }
}
