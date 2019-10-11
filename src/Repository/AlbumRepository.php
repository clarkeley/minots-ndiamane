<?php

namespace App\Repository;

use App\Entity\Album;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Album|null find($id, $lockMode = null, $lockVersion = null)
 * @method Album|null findOneBy(array $criteria, array $orderBy = null)
 * @method Album[]    findAll()
 * @method Album[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlbumRepository extends ServiceEntityRepository
{
    const LIMIT_PER_PAGE = 2;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Album::class);
    }

    public function getAll($page)
    {
        return $this->createQueryBuilder('a')
            ->setMaxResults(self::LIMIT_PER_PAGE)
            ->setFirstResult(($page-1)*self::LIMIT_PER_PAGE)
            ->getQuery()
            ->getResult();
    }

    public function getMaxPage()
    {
        $total =  $this->count([]);
        return ceil($total/self::LIMIT_PER_PAGE);
    }

    // /**
    //  * @return Album[] Returns an array of Album objects
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
    public function findOneBySomeField($value): ?Album
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
