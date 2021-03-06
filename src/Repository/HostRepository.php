<?php

namespace App\Repository;

use App\Entity\Host;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

use App\AdminBundle\Model\Registry\RegistryGrid;

/**
 * @method Host|null find($id, $lockMode = null, $lockVersion = null)
 * @method Host|null findOneBy(array $criteria, array $orderBy = null)
 * @method Host[]    findAll()
 * @method Host[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HostRepository extends ServiceEntityRepository implements RegistryGrid
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Host::class);
    }

    public function getByPage($offset = 0, 
                    $limit = 50, $sortby = "id", 
                    $sorttype = "ASC", $search = null)
    {
        $qb = $this->createQueryBuilder('p');

        if ($search) {
            $qb->where('p.username LIKE :src OR p.mac LIKE :src')
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
            $qb->where('p.username LIKE :src OR p.mac LIKE :src')
                ->setParameter('src', $search.'%');
        }
            
        $query = $qb->getQuery();
        $res = $query->getSingleScalarResult();

        return $res;
    }
//    /**
//     * @return Host[] Returns an array of Host objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Host
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
