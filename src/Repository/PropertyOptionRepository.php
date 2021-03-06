<?php

namespace App\Repository;

use App\Entity\PropertyOption;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PropertyOption|null find($id, $lockMode = null, $lockVersion = null)
 * @method PropertyOption|null findOneBy(array $criteria, array $orderBy = null)
 * @method PropertyOption[]    findAll()
 * @method PropertyOption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyOptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PropertyOption::class);
    }

    // /**
    //  * @return PropertyOption[] Returns an array of PropertyOption objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PropertyOption
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
