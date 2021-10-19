<?php

namespace App\Repository;

use App\Entity\Shader;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Shader|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shader|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shader[]    findAll()
 * @method Shader[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShaderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Shader::class);
    }

    // /**
    //  * @return Shader[] Returns an array of Shader objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Shader
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
