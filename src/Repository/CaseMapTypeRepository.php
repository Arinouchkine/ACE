<?php

namespace App\Repository;

use App\Entity\CaseMapType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CaseMapType|null find($id, $lockMode = null, $lockVersion = null)
 * @method CaseMapType|null findOneBy(array $criteria, array $orderBy = null)
 * @method CaseMapType[]    findAll()
 * @method CaseMapType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaseMapTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CaseMapType::class);
    }

    // /**
    //  * @return CaseMapType[] Returns an array of CaseMapType objects
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
    public function findOneBySomeField($value): ?CaseMapType
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
