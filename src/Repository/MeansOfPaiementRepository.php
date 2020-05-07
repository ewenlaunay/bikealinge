<?php

namespace App\Repository;

use App\Entity\MeansOfPaiement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MeansOfPaiement|null find($id, $lockMode = null, $lockVersion = null)
 * @method MeansOfPaiement|null findOneBy(array $criteria, array $orderBy = null)
 * @method MeansOfPaiement[]    findAll()
 * @method MeansOfPaiement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeansOfPaiementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MeansOfPaiement::class);
    }

    // /**
    //  * @return MeansOfPaiement[] Returns an array of MeansOfPaiement objects
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
    public function findOneBySomeField($value): ?MeansOfPaiement
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
