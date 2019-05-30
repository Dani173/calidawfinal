<?php

namespace App\Repository;

use App\Entity\Musclegropus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Musclegropus|null find($id, $lockMode = null, $lockVersion = null)
 * @method Musclegropus|null findOneBy(array $criteria, array $orderBy = null)
 * @method Musclegropus[]    findAll()
 * @method Musclegropus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MusclegropusRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Musclegropus::class);
    }

    // /**
    //  * @return Musclegropus[] Returns an array of Musclegropus objects
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
    public function findOneBySomeField($value): ?Musclegropus
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
