<?php

namespace App\Repository;

use App\Entity\NewsletterUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NewsletterUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method NewsletterUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method NewsletterUser[]    findAll()
 * @method NewsletterUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsletterUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NewsletterUser::class);
    }

    // /**
    //  * @return NewsletterUser[] Returns an array of NewsletterUser objects
    //  */
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
    public function findOneBySomeField($value): ?NewsletterUser
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
