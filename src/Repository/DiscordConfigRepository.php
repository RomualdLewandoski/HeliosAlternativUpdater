<?php

namespace App\Repository;

use App\Entity\DiscordConfig;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DiscordConfig|null find($id, $lockMode = null, $lockVersion = null)
 * @method DiscordConfig|null findOneBy(array $criteria, array $orderBy = null)
 * @method DiscordConfig[]    findAll()
 * @method DiscordConfig[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiscordConfigRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DiscordConfig::class);
    }

    // /**
    //  * @return DiscordConfig[] Returns an array of DiscordConfig objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DiscordConfig
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
