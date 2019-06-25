<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 25/06/2019
 * Time: 09:47
 */

namespace App\Repository;


use App\Entity\QCM;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method QCM|null find($id, $lockMode = null, $lockVersion = null)
 * @method QCM|null findOneBy(array $criteria, array $orderBy = null)
 * @method QCM[]    findAll()
 * @method QCM[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class QCMRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, QCM::class);
    }

    public function getOneQuestionByDifficulty($diff)
    {
        $qbCOUNT = $this->createQueryBuilder('qcm')
            ->andWhere('qcm.difficulty = :diff')->setParameter('diff',$diff)
            ->select('count(qcm.id) as nbm')
            ->getQuery()
            ->execute();
        $nbr = $qbCOUNT[0]['nbm'] - 1;
        $qb= $this->createQueryBuilder('qcm')
            ->andWhere('qcm.difficulty = :diff')->setParameter('diff',$diff)
            ->setMaxResults(1)
            ->setFirstResult(rand(0, $nbr ))
            ->getQuery();
        return $qb->execute();
    }
}