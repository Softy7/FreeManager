<?php

namespace App\Repository;

use App\Entity\Quote;
use DivisionByZeroError;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Quote>
 */
class QuoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quote::class);
    }

    //    /**
    //     * @return Quote[] Returns an array of Quote objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('q')
    //            ->andWhere('q.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('q.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    public function findCATotal(): float
    {
        $CA = 0;
        $array = $this->createQueryBuilder('q')
                ->where('q.status = 4')
                ->getQuery()
                ->getArrayResult();
        
        foreach($array as $element) {
            $CA += $element['total_ht'];
        }

        return $CA;
    }

    public function findAcceptedQuote(): int
    {
        $array = $this->createQueryBuilder('q')
                ->orWhere('q.status = 4')
                ->orWhere('q.status = 2')
                ->getQuery()
                ->getArrayResult();

        $all = $this->findAll();

        try {
            return count($array)/count($all)*100;
        } catch (DivisionByZeroError $e) {
            return 0;
        }   
        
    }
}