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
    #[Route('/event')]
    public function getNextOccurrence(Request $request, ReccuringEventOccurenceRepository $repository): JsonResponse
    {
        $now = new DateTimeImmutable();
        $recurringEventId = $request->query->get('reccuringEvent');

        if (!$recurringEventId) {
            return $this->json(['error' => 'Data někam zabloudili..'], 400);
        }

        $result = $repository->createQueryBuilder('r')
            ->andWhere('r.reccuringEvent = :val')
            ->andWhere('r.timestamp >= :now')
            ->setParameter('val', $recurringEventId)
            ->setParameter('now', $now)
            ->orderBy('r.timestamp', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        if (!$result) {
            return $this->json(['error' => 'No occurrence found for the given event ID'], 404);
        }
                $response = [
                    'timestamp' => $result->getTimestamp()->format('Y-m-d H:i:s'),
                    'duration' => $result->getDuration(),
                    'recurringEvent' => [
                        'name' => $result->getReccuringEvent()->getName(),
                        'note' => $result->getNote(),
                    ]
                ];
        
        return $this->json($response);
    }
}
