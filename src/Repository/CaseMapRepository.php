<?php

namespace App\Repository;

use App\Entity\CaseMap;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CaseMap|null find($id, $lockMode = null, $lockVersion = null)
 * @method CaseMap|null findOneBy(array $criteria, array $orderBy = null)
 * @method CaseMap[]    findAll()
 * @method CaseMap[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaseMapRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CaseMap::class);
    }

    // /**
    //  * @return CaseMap[] Returns an array of CaseMap objects
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
    public function findOneBySomeField($value): ?CaseMap
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
