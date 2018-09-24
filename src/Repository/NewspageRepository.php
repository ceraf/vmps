<?php

namespace App\Repository;

use App\Entity\Newspage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Newspage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Newspage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Newspage[]    findAll()
 * @method Newspage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewspageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Newspage::class);
    }

//    /**
//     * @return Newspage[] Returns an array of Newspage objects
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
    public function findOneBySomeField($value): ?Newspage
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
