<?php

namespace App\Repository;

use App\Entity\Estudios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Estudios|null find($id, $lockMode = null, $lockVersion = null)
 * @method Estudios|null findOneBy(array $criteria, array $orderBy = null)
 * @method Estudios[]    findAll()
 * @method Estudios[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstudiosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Estudios::class);
    }

    // /**
    //  * @return Estudios[] Returns an array of Estudios objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Estudios
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
