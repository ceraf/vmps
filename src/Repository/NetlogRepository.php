<?php

namespace App\Repository;

use App\Entity\Netlog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

use App\AdminBundle\Model\Registry\RegistryGrid;

/**
 * @method Netlog|null find($id, $lockMode = null, $lockVersion = null)
 * @method Netlog|null findOneBy(array $criteria, array $orderBy = null)
 * @method Netlog[]    findAll()
 * @method Netlog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NetlogRepository extends ServiceEntityRepository implements RegistryGrid
{ 
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Netlog::class);
    }

    public function getByPage($offset = 0, 
                    $limit = 50, $sortby = "id", 
                    $sorttype = "ASC", $search = null)
    {
        $qb = $this->createQueryBuilder('p');

        if ($search) {
            $qb->where('p.mac LIKE :src OR p.vl_name LIKE :src
					OR p.ip LIKE :src OR p.interface LIKE :src')
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
            $qb->where('p.mac LIKE :src OR p.vl_name LIKE :src
					OR p.ip LIKE :src OR p.interface LIKE :src')
                ->setParameter('src', $search.'%');
        }

        $query = $qb->getQuery();
        $res = $query->getSingleScalarResult();

        return $res;
    }
	
//    /**
//     * @return Netlog[] Returns an array of Netlog objects
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
    public function findOneBySomeField($value): ?Netlog
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
