<?php

namespace App\Repository;

use App\Entity\FirstPartyDevice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FirstPartyDevice|null find($id, $lockMode = null, $lockVersion = null)
 * @method FirstPartyDevice|null findOneBy(array $criteria, array $orderBy = null)
 * @method FirstPartyDevice[]    findAll()
 * @method FirstPartyDevice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FirstPartyDeviceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FirstPartyDevice::class);
    }

    // /**
    //  * @return FirstPartyDevice[] Returns an array of FirstPartyDevice objects
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
    public function findOneBySomeField($value): ?FirstPartyDevice
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
