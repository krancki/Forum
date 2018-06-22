<?php

namespace App\Repository;

use App\Entity\SessionTab;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SessionTab|null find($id, $lockMode = null, $lockVersion = null)
 * @method SessionTab|null findOneBy(array $criteria, array $orderBy = null)
 * @method SessionTab[]    findAll()
 * @method SessionTab[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SessionTabRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SessionTab::class);
    }

//    /**
//     * @return SessionTab[] Returns an array of SessionTab objects
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
    public function findOneBySomeField($value): ?SessionTab
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
