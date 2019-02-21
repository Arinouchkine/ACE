<?php

namespace App\Repository;

use App\Entity\CaseMapEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CaseMapEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method CaseMapEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method CaseMapEvent[]    findAll()
 * @method CaseMapEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaseMapEventRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CaseMapEvent::class);
    }

    // /**
    //  * @return CaseMapEvent[] Returns an array of CaseMapEvent objects
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
    public function findOneBySomeField($value): ?CaseMapEvent
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
