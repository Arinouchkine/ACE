<?php

namespace App\Repository;

use App\Entity\CaseMapEventType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CaseMapEventType|null find($id, $lockMode = null, $lockVersion = null)
 * @method CaseMapEventType|null findOneBy(array $criteria, array $orderBy = null)
 * @method CaseMapEventType[]    findAll()
 * @method CaseMapEventType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaseMapEventTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CaseMapEventType::class);
    }

    // /**
    //  * @return CaseMapEventType[] Returns an array of CaseMapEventType objects
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
    public function findOneBySomeField($value): ?CaseMapEventType
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
