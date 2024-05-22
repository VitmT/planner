<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ReccuringEventRepository;

class EventOccurenceListController extends AbstractController
{
    #[Route('/event-list', name: 'event-list')]
    public function eventoccurencelist(ReccuringEventRepository $reccuringEventRepository): Response
    {
	    $reccuringEvents = $reccuringEventRepository->getRecurringEventsForUser($this->getUser());
        if (count($reccuringEvents) == 1) {
            $recurringEvent = $reccuringEvents[0];
            return $this->redirectToRoute("new-event", ["recurringEvent" => $recurringEvent->getId()]);
        }

        return $this->render('EventOccurenceList.html.twig',[
             "events" => $reccuringEvents
        ]);
 
    }
}
