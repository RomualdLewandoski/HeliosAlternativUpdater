<?php

namespace App\Repository;

use App\Entity\FMod;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FMod|null find($id, $lockMode = null, $lockVersion = null)
 * @method FMod|null findOneBy(array $criteria, array $orderBy = null)
 * @method FMod[]    findAll()
 * @method FMod[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FModRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FMod::class);
    }

    // /**
    //  * @return FMod[] Returns an array of FMod objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FMod
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
