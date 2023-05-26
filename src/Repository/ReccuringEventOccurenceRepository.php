<?php

namespace App\Repository;

use App\Entity\ReccuringEventOccurence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\ReccuringEvent as RecurringEvent;
use App\Repository\ReccuringEventRepository;
use DateTimeInterface;

/**
 * @extends ServiceEntityRepository<ReccuringEventOccurence>
 *
 * @method ReccuringEventOccurence|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReccuringEventOccurence|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReccuringEventOccurence[]    findAll()
 * @method ReccuringEventOccurence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReccuringEventOccurenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReccuringEventOccurence::class);
    }

    public function save(ReccuringEventOccurence $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ReccuringEventOccurence $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getLastOccurrence(RecurringEvent $recurringEvent): ?ReccuringEventOccurence
    {
        $queryBuilder = $this->createQueryBuilder('r');
    
        $result = $queryBuilder
            ->andWhere('r.reccuringEvent = :val')
            ->setParameter('val', $recurringEvent->getId())
            ->orderBy('r.timestamp', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    
        return $result;
    }
    // Repository method
public function getNextOccurence(RecurringEvent $recurringEvent, DateTimeInterface $now): ?ReccuringEventOccurence
{
    $queryBuilder = $this->createQueryBuilder('r');

    $result = $queryBuilder
        ->andWhere('r.reccuringEvent = :val')
        ->andWhere('r.timestamp >= :now') 
        ->setParameter('val', $recurringEvent->getId())
        ->setParameter('now', $now)
        ->orderBy('r.timestamp', 'ASC')
        ->setMaxResults(1)
        ->getQuery()
        ->getOneOrNullResult();

    return $result;
}

//    /**
//     * @return ReccuringEventOccurence[] Returns an array of ReccuringEventOccurence objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ReccuringEventOccurence
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
