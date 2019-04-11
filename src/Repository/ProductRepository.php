<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

    

    /**
     * @return Product[]
     */
    public function findLast4Products()
    {
        $queryBuilder = $this->createQueryBuilder('p')
            //->where('p.name LIKE :name')
            //->setParameter('name', '%iphone%')
            ->orderBy('p.date', 'DESC')
            ->setMaxResults(4)
            ->getQuery();
        return $queryBuilder->execute();
    }

    public function findBestScore()
    {
        $queryBuilder = $this->createQueryBuilder('p')
            //->where('p.name LIKE :name')
            //->setParameter('name', '%iphone%')
            ->orderBy('p.score', 'DESC')
            ->setMaxResults(4)
            ->getQuery();
        return $queryBuilder->execute();
    }

    public function findFavorite()
    {
        $queryBuilder = $this->createQueryBuilder('p')
            ->where('p.favorite = 1')
            //->setParameter('name', '%iphone%')
            ->getQuery();
        return $queryBuilder->execute();
    }

    public function findLastProduct()
    {
        $queryBuilder = $this->createQueryBuilder('p')

        ->orderBy('p.date', 'DESC')
        ->setMaxResults(1)
        ->getQuery();

        return $queryBuilder->execute();
    }

    public function findByCategory_id($category)
    {
        $queryBuilder = $this->createQueryBuilder('p')
            ->where('p.category = :category')
            ->setParameter('category', $category)
            ->getQuery();
          return $queryBuilder->execute();
  
    }
    // /**
    //  * @return Product[] Returns an array of Product objects
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
    public function findOneBySomeField($value): ?Product
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
