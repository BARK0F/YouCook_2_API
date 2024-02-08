<?php

namespace App\Repository;

use App\Entity\RecipesCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RecipesCategory>
 *
 * @method RecipesCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecipesCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecipesCategory[]    findAll()
 * @method RecipesCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipesCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecipesCategory::class);
    }
}
