<?php

namespace App\Repository;

use App\Entity\ReccuringEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;

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
//            ->orderBy('r.id', 'ASC')
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }}

    public function getRecurringEventsForUser(User $user): array
    {
        if ($user->hasAccessToAllEvents()) {
            return $this->findAll();
        } else {
            return $user->getEvents()->toArray();
        }
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
