<?php

namespace App\Repository;

use App\Entity\Apiary;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Apiary|null find($id, $lockMode = null, $lockVersion = null)
 * @method Apiary|null findOneBy(array $criteria, array $orderBy = null)
 * @method Apiary[]    findAll()
 * @method Apiary[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApiaryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Apiary::class);
    }

    // /**
    //  * @return Apiary[] Returns an array of Apiary objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Apiary
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
