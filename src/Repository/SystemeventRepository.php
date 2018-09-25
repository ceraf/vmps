<?php

namespace App\Repository;

use App\Entity\Systemevent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

use App\AdminBundle\Model\Registry\RegistryGrid;

/**
 * @method Systemevent|null find($id, $lockMode = null, $lockVersion = null)
 * @method Systemevent|null findOneBy(array $criteria, array $orderBy = null)
 * @method Systemevent[]    findAll()
 * @method Systemevent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SystemeventRepository extends ServiceEntityRepository implements RegistryGrid
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Systemevent::class);
    }

    public function getByPage($offset = 0, 
                    $limit = 50, $sortby = "id", 
                    $sorttype = "ASC", $search = null)
    {
        $qb = $this->createQueryBuilder('p');

        if ($search) {
            $qb->where('p.mes LIKE :src')
                ->setParameter('src', '%'.$search.'%');
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
            $qb->where('p.mes LIKE :src')
                ->setParameter('src', '%'.$search.'%');
        }
            
        $query = $qb->getQuery();
        $res = $query->getSingleScalarResult();

        return $res;
    }
    
//    /**
//     * @return Systemevent[] Returns an array of Systemevent objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Systemevent
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
