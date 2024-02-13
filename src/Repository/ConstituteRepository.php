<?php

namespace App\Repository;

use App\Entity\Constitute;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Constitute>
 *
 * @method Constitute|null find($id, $lockMode = null, $lockVersion = null)
 * @method Constitute|null findOneBy(array $criteria, array $orderBy = null)
 * @method Constitute[]    findAll()
 * @method Constitute[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConstituteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Constitute::class);
    }
}
