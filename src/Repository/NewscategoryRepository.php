<?php

namespace App\Repository;

use App\Entity\Newscategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Newscategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method Newscategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method Newscategory[]    findAll()
 * @method Newscategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewscategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Newscategory::class);
    }

//    /**
//     * @return Newscategory[] Returns an array of Newscategory objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Newscategory
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
