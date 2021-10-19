<?php

namespace App\Repository;

use App\Entity\ForgeHosted;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ForgeHosted|null find($id, $lockMode = null, $lockVersion = null)
 * @method ForgeHosted|null findOneBy(array $criteria, array $orderBy = null)
 * @method ForgeHosted[]    findAll()
 * @method ForgeHosted[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForgeHostedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForgeHosted::class);
    }

    // /**
    //  * @return ForgeHosted[] Returns an array of ForgeHosted objects
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
    public function findOneBySomeField($value): ?ForgeHosted
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
