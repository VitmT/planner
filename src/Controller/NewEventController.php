<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\EventOccurenceFormType;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\ReccuringEventOccurence as RecurringEventOccurence;
use App\Entity\ReccuringEvent as RecurringEvent;
use App\Recurrence\RecurringService;
use DateTimeImmutable;


class NewEventController extends AbstractController
{
    public function __construct(EntityManager $entityManager, private RecurringService $recurringService)
    {
        parent::__construct($entityManager);
    }

    #[Route('/new/{recurringEvent}', name: 'new-event')]
    #[Route('/edit/{occurence}', name: 'edit-event')]
    public function edit(
        ?RecurringEvent $recurringEvent,
        ?RecurringEventOccurence $occurence,
        Request $request
    ): Response
    {
        $showDelete = true;
        if ($occurence === null) {
            $occurence = $this->createNewOccurence($recurringEvent);
            $showDelete = false;
	} else {
		$recurringEvent = $occurence->getRecurringEvent()
	}
        $form = $this->createForm(EventOccurenceFormType::class, $occurence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $occurence = $form->getData();
            $this->getEntityManager()->persist($occurence);
            $this->getEntityManager()->flush();

            return $this->redirectToRoute('app_index');
        }

        return $this->render('EventOccurenceForm.html.twig', [
            'form' => $form->createView(),
            'occurence' => $occurence,
            'showDelete' => $showDelete,
        ]);
    }

    #[Route('/delete/{occurence}', name: 'delete-event')]
    public function deleteEvent (?RecurringEventOccurence $occurence)
    {
      if ($occurence !== null) {
        $this->getEntityManager()->remove($occurence);
        $this->getEntityManager()->flush();
      }
      return $this->redirectToRoute ('app_index');
    }
    

    private function createNewOccurence(RecurringEvent $recurringEvent): RecurringEventOccurence
    {
        $occurence = new RecurringEventOccurence();
        $occurence->setReccuringEvent($recurringEvent);
        $recurrence = $this->recurringService->getRecurrence($recurringEvent->getReccurenceType());
        $defaultTimestamp = $recurringEvent->getDefaultTimestamp();
        if ($defaultTimestamp !== null) {
            $defaultTimestamp = DateTimeImmutable::createFromInterface($defaultTimestamp);
            $now = new DateTimeImmutable();
            $lastOccurenceTimestamp = $this->getLastOccurenceTimestamp($recurringEvent);
            $scheduledTimestamp = $recurrence->getNextTimestamp($defaultTimestamp, $now, $lastOccurenceTimestamp);
        } else {
            $scheduledTimestamp = new DateTimeImmutable();
        }
        $occurence->setTimestamp($scheduledTimestamp);
        $occurence->setDuration(60);
        return $occurence;
    }

    private function getLastOccurenceTimestamp(RecurringEvent $recurringEvent): ?DateTimeImmutable
{
    $lastOccurrence = $this->getRepository(RecurringEventOccurence::class)->getLastOccurrence($recurringEvent);
    
    if ($lastOccurrence === null) {
        return null;
    }
    else
    {
        return DateTimeImmutable::createFromMutable($lastOccurrence->getTimestamp());
    }
    
}

}
