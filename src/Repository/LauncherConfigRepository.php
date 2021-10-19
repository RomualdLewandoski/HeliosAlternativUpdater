<?php

namespace App\Repository;

use App\Entity\LauncherConfig;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LauncherConfig|null find($id, $lockMode = null, $lockVersion = null)
 * @method LauncherConfig|null findOneBy(array $criteria, array $orderBy = null)
 * @method LauncherConfig[]    findAll()
 * @method LauncherConfig[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LauncherConfigRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LauncherConfig::class);
    }

    // /**
    //  * @return LauncherConfig[] Returns an array of LauncherConfig objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LauncherConfig
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
