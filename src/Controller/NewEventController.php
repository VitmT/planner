<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\EventOccurenceFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\ReccuringEventOccurence as RecurringEventOccurence;
use App\Entity\ReccuringEventOccurence;
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

    #[Route('/new/{reccuringEventId}', name: 'new-event')]
    public function new(
        int $reccuringEventId,
        ReccuringEventRepository $reccuringEventRepository
    ): Response
    {
        $reccuringEvent = $reccuringEventRepository->find($reccuringEventId);
        $reccuringEventOccurence = new ReccuringEventOccurence();
        $reccuringEventOccurence->setReccuringEvent($reccuringEvent);

        return $this->handleRequest($reccuringEventOccurence);
    }

    #[Route('/edit/{id}', name: 'edit-event')]
    public function edit(
        int $id,
        ReccuringEventOccurenceRepository $reccuringEventOccurenceRepository
    ): Response
    {
        return $this->handleRequest($reccuringEventOccurenceRepository->find($id));
    }

    private function handleRequest(RecurringEventOccurence $reccuringEventOccurence): Response
    {
        $request = $this->requestStack->getMainRequest();
        $form = $this->createForm(EventOccurenceFormType::class, $reccuringEventOccurence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reccuringEventOccurence = $form->getData();
            $this->entityManager->persist($reccuringEventOccurence);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_index');
        }

        return $this->render('EventOccurenceForm.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
