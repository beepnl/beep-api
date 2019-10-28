<?php

namespace App\Repository;

use App\Entity\Hive;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Hive|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hive|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hive[]    findAll()
 * @method Hive[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HiveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hive::class);
    }

    // /**
    //  * @return Hive[] Returns an array of Hive objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Hive
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
