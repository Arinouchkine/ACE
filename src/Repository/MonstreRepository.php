<?php

namespace App\Repository;

use App\Entity\Monstre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Monstre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Monstre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Monstre[]    findAll()
 * @method Monstre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MonstreRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Monstre::class);
    }

    // /**
    //  * @return Monstre[] Returns an array of Monstre objects
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
    public function findOneBySomeField($value): ?Monstre
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

public function CreateMonster(Monstre $monster){

    $qb = $this->createQueryBuilder('QCM');
    $return = array();
    $qb->andWhere('difficulty = 1');
    $questionsEasy = $qb->getQuery()->getResult();
    for ($i=0;$i<$monster->getNbrEasyQuestion();$i++)
    {
      $return['easy'][$i]= $questionsEasy[rand(0,sizeof($questionsEasy))];
    }
    $qb2 = $this->createQueryBuilder('QCM');
    $return = array();
    $qb2->andWhere('difficulty = 2');
    $questionsMedium = $qb2->getQuery()->getResult();
    for ($i=0;$i<$monster->getNbrMediumQuestion();$i++)
    {
        $return['medium'][$i]= $questionsMedium[rand(0,sizeof($questionsMedium))];
    }
    $qb3 = $this->createQueryBuilder('QCM');
    $return = array();
    $qb3->andWhere('difficulty = 3');
    $questionsHard = $qb3->getQuery()->getResult();
    for ($i=0;$i<$monster->getNbrHardQuestion();$i++)
    {
        $return['hard'][$i]= $questionsHard[rand(0,sizeof($questionsHard))];
    }

    return $return;
}
    public function AjoutQuestion(Monstre $monstre, $difficulty){



    }
}
