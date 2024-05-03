<?php

namespace App\Controller;

use App\Entity\ReccuringEvent as RecurringEvent;
use App\Entity\ReccuringEventOccurence;
use App\Repository\ReccuringEventOccurenceRepository;
use App\Repository\ReccuringEventRepository;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class JsonEndpoint extends AbstractController
{
    #[Route('/json-endpoint')]
    public function getNextOccurrence(Request $request): JsonResponse
    {
        $now = new DateTimeImmutable();
        $recurringEventId = $request->query->get('reccuringEvent');
        $repository = $this->getRepository(ReccuringEventOccurence::class);

        $result = $repository->createQueryBuilder('r')
            ->andWhere('r.reccuringEvent = :val')
            ->andWhere('r.timestamp >= :now')
            ->setParameter('val', $recurringEventId)
            ->setParameter('now', $now)
            ->orderBy('r.timestamp', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        return $this->json($result);
    }
}
