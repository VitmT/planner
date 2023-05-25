<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\EventOccurenceFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\ReccuringEventOccurence as RecurringEventOccurence;
use App\Entity\ReccuringEvent as RecurringEvent;
use App\Repository\ReccuringEventOccurenceRepository;
use App\Repository\ReccuringEventRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class NewEventController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private RequestStack $requestStack
    ) {
    }

    #[Route('/new/{recurringEvent}', name: 'new-event')]
    #[Route('/edit/{occurence}', name: 'edit-event')]
    public function edit(
        ?RecurringEvent $recurringEvent,
        ?RecurringEventOccurence $occurence,
        Request $request
    ): Response
    {
        if ($occurence === null) {
            $occurence = $this->createNewOccurence($recurringEvent);
        }
        $form = $this->createForm(EventOccurenceFormType::class, $occurence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $occurence = $form->getData();
            $this->entityManager->persist($occurence);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_index');
        }

        return $this->render('EventOccurenceForm.html.twig', [
            'form' => $form->createView(),
            'occurence' => $occurence
        ]);
    }

    #[Route('/delete/{id}', name: 'delete-event')]
    public function deleteEvent ($id, EntityManagerInterface $em) // add this parameter
    {
      $event = $em->getRepository (RecurringEventOccurence::class)->find ($id);
      $em->remove ($event);
      $em->flush ();
      return $this->redirectToRoute ('app_index');
    }
    

    private function createNewOccurence(RecurringEvent $recurringEvent): RecurringEventOccurence
    {
        $occurence = new RecurringEventOccurence();
        $occurence->setReccuringEvent($recurringEvent);
        $occurence->setTimestamp(new \DateTime());
        $occurence->setDuration(60);
        return $occurence;
    }
}
