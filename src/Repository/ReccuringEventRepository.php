<?php

namespace App\Repository;

use App\Entity\ReccuringEvent;
use App\Entity\ReccuringEventOccurence;
use DateTimeInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @extends ServiceEntityRepository<ReccuringEvent>
 *
 * @method ReccuringEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReccuringEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReccuringEvent[]    findAll()
 * @method ReccuringEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReccuringEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReccuringEvent::class);
    }

    public function save(ReccuringEvent $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ReccuringEvent $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function getLastOccurrence(ReccuringEvent $reccuringEvent): ?ReccuringEventOccurence
    {
        $queryBuilder = $this->createQueryBuilder('r');
    
        $result = $queryBuilder
            ->andWhere('r.recurringId = :val')
            ->setParameter('val', $reccuringEvent->getId())
            ->orderBy('r.timestamp', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleResult();
    
        return $result;
    }
    public function getNextOccurrence(ReccuringEvent $reccuringEvent, DateTimeInterface $now): ?ReccuringEventOccurence
    {
        $queryBuilder = $this->createQueryBuilder('r');
    
        $result = $queryBuilder
            ->andWhere('r.recurringId = :val')
            ->andWhere('r.now = :val')
            ->setParameter('val', $reccuringEvent->getId())
            ->orderBy('r.timestamp', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleResult();
    
        return $result;
    }
//    /**
//     * @return ReccuringEvent[] Returns an array of ReccuringEvent objects
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

//    public function findOneBySomeField($value): ?ReccuringEvent
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
