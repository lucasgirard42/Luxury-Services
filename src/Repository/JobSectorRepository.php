<?php

namespace App\Repository;

use App\Entity\Jobsector;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Jobsector|null find($id, $lockMode = null, $lockVersion = null)
 * @method Jobsector|null findOneBy(array $criteria, array $orderBy = null)
 * @method Jobsector[]    findAll()
 * @method Jobsector[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobsectorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Jobsector::class);
    }

    // /**
    //  * @return Jobsector[] Returns an array of Jobsector objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Jobsector
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
