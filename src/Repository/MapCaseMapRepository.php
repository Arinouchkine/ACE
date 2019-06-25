<?php

namespace App\Repository;

use App\Entity\MapCaseMap;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MapCaseMap|null find($id, $lockMode = null, $lockVersion = null)
 * @method MapCaseMap|null findOneBy(array $criteria, array $orderBy = null)
 * @method MapCaseMap[]    findAll()
 * @method MapCaseMap[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MapCaseMapRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MapCaseMap::class);
    }

    // /**
    //  * @return MapCaseMap[] Returns an array of MapCaseMap objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MapCaseMap
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
