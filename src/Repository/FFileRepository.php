<?php

namespace App\Repository;

use App\Entity\FFile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FFile|null find($id, $lockMode = null, $lockVersion = null)
 * @method FFile|null findOneBy(array $criteria, array $orderBy = null)
 * @method FFile[]    findAll()
 * @method FFile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FFileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FFile::class);
    }

    // /**
    //  * @return FFile[] Returns an array of FFile objects
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
    public function findOneBySomeField($value): ?FFile
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
