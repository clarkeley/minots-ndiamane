<?php

namespace App\Repository;

use App\Entity\AccountManagement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AccountManagement|null find($id, $lockMode = null, $lockVersion = null)
 * @method AccountManagement|null findOneBy(array $criteria, array $orderBy = null)
 * @method AccountManagement[]    findAll()
 * @method AccountManagement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccountManagementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccountManagement::class);
    }

    // /**
    //  * @return AccountManagement[] Returns an array of AccountManagement objects
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
    public function findOneBySomeField($value): ?AccountManagement
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
