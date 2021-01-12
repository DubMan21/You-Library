<?php

namespace App\Repository;

use App\Entity\Book;
use App\Entity\BookSearch;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public const PAGINATOR_PER_PAGE = 6;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
     * @return Book[] Returns an array of Book objects
    */
    public function findLastThree()
    {
        return $this->createQueryBuilder('b')
            ->orderBy('b.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Book[] Returns an array of Book objects
    */
    public function getBookPaginator(BookSearch $booksearch, int $offset)
    {
        $query = $this->createQueryBuilder('b')
            ->orderBy('b.id', 'DESC')
        ;

        if($booksearch->getMinPrice()) {
            $query = $query
                ->andWhere('b.price >= :minprice')
                ->setParameter('minprice', $booksearch->getMinPrice())
            ;
        }
        if($booksearch->getMaxPrice()) {
            $query = $query
                ->andWhere('b.price <= :maxprice')
                ->setParameter('maxprice', $booksearch->getMaxPrice())
            ;
        }
        if($booksearch->getSearch()) {
            $query = $query
                ->andWhere('b.title LIKE :search OR b.isbn LIKE :search')
                ->setParameter('search', '%' . $booksearch->getSearch() . '%')
            ;
        }
        if($booksearch->getCategory()) {
            $query = $query
                ->andWhere(':category MEMBER OF b.categories')
                ->setParameter('category', $booksearch->getCategory())
            ;
        }

        $query = $query
            ->setMaxResults(self::PAGINATOR_PER_PAGE)
            ->setFirstResult($offset)
            ->getQuery()
        ;

        return new Paginator($query);
    }

    /*
    public function findOneBySomeField($value): ?Book
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
