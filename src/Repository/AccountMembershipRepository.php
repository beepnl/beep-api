<?php

namespace App\Repository;

use App\Entity\AccountMembership;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AccountMembership|null find($id, $lockMode = null, $lockVersion = null)
 * @method AccountMembership|null findOneBy(array $criteria, array $orderBy = null)
 * @method AccountMembership[]    findAll()
 * @method AccountMembership[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccountMembershipRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccountMembership::class);
    }

    // /**
    //  * @return AccountMembership[] Returns an array of AccountMembership objects
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
    public function findOneBySomeField($value): ?AccountMembership
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
