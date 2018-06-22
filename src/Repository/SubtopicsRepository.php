<?php

namespace App\Repository;

use App\Entity\Subtopics;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Subtopics|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subtopics|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subtopics[]    findAll()
 * @method Subtopics[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubtopicsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Subtopics::class);
    }

//    /**
//     * @return Subtopics[] Returns an array of Subtopics objects
//     */
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
    public function findOneBySomeField($value): ?Subtopics
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
