<?php

namespace App\Repository;

use App\Entity\Nas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

use App\AdminBundle\Model\Registry\RegistryGrid;

/**
 * @method Nas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nas[]    findAll()
 * @method Nas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NasRepository extends ServiceEntityRepository implements RegistryGrid
{ 
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Nas::class);
    }

    public function getByPage($offset = 0, 
                    $limit = 50, $sortby = "id", 
                    $sorttype = "ASC", $search = null)
    {
        $qb = $this->createQueryBuilder('p');

        if ($search) {
            $qb->where('p.ip LIKE :src')
                ->setParameter('src', $search.'%');
        }
            
        $query = $qb->orderBy('p.'.$sortby, $sorttype)
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->getQuery();
        $res = $query->getResult();
    
        return $res;
    }
    
    public function getTotal($search)
    {
        $qb = $this->createQueryBuilder('p')
                ->select('count(p)');
            
        if ($search) {
            $qb->where('p.ip LIKE :src')
                ->setParameter('src', $search.'%');
        }
            
        $query = $qb->getQuery();
        $res = $query->getSingleScalarResult();

        return $res;
    }
    
//    /**
//     * @return Nas[] Returns an array of Nas objects
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
    public function findOneBySomeField($value): ?Nas
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
