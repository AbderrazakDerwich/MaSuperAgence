<?php

namespace App\Repository;

use App\Entity\Search;
use App\Entity\Property;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
     * @return Property[] Returns an array of Property objects
     */
    public function findBySearch(Search $search)
    {
        if ($search->getMinPrice()) {
            $query = $this->createQueryBuilder('p')
                ->andWhere('p.price >= :val')
                ->setParameter('val', $search->getMinPrice())
                ->getQuery()
                ->getResult();
        }
        if ($search->getMinSurface()) {
            $query = $this->createQueryBuilder('p')
                ->andWhere('p.surface >= :val')
                ->setParameter('val', $search->getMinSurface())
                ->getQuery()
                ->getResult();
        }
        return $query;
    }

    /**
     * @return Property[] Returns an array of Property objects
     */
    public function findProperty()
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.sold = :val')
            ->setParameter('val', true)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Property[] Returns an array of Property objects
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
    public function findOneBySomeField($value): ?Property
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
