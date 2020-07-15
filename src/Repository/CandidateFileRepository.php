<?php

namespace App\Repository;

use App\Entity\CandidateFile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CandidateFile|null find($id, $lockMode = null, $lockVersion = null)
 * @method CandidateFile|null findOneBy(array $criteria, array $orderBy = null)
 * @method CandidateFile[]    findAll()
 * @method CandidateFile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidateFileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CandidateFile::class);
    }

    // /**
    //  * @return CandidateFile[] Returns an array of CandidateFile objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CandidateFile
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
