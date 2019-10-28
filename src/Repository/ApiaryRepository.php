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
}
