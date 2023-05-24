<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\EventOccurenceFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\ReccuringEventOccurence as RecurringEventOccurence;
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

    #[Route('/new-event', name: 'ushdfaish')]
    public function login(?int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($id === null) {
            $recurringEventOccurence = new RecurringEventOccurence();
        } else {
            $recurringEventOccurence = $this->getRepository(RecurringEventOccurence::class)->find($id);
        }
        //$reccuringEventOccurence = [];//new ReccuringEvent();
                
        $form = $this->createForm(EventOccurenceFormType::class, $recurringEventOccurence);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reccuringEvent = $form->getData();
            $reccuringEvent->setUser($this->getUser());
            $entityManager->persist($reccuringEvent);
            $entityManager->flush();

            return $this->redirectToRoute('app_index');
        }

        return $this->render('EventOccurenceForm.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/new/{reccuringEventId}', name: 'new-event')]
    public function new(
        int $reccuringEventId,
        ReccuringEventRepository $reccuringEventRepository
    ): Response
    {
        $reccuringEvent = $reccuringEventRepository->find($reccuringEventId);

        return $this->neco();
    }

    #[Route('/edit/{id}', name: 'edit-event')]
    public function edit(
        int $id,
        ReccuringEventOccurenceRepository $reccuringEventOccurenceRepository
    ): Response
    {
        $reccuringEventOccurence = $reccuringEventOccurenceRepository->find($id);
        $reccuringEvent = $reccuringEventOccurence->getReccuringEvent();

        return $this->neco();
    }

    private function neco(): Response
    {
        $request = $this->requestStack->getMainRequest();
        $form = $this->createForm(EventOccurenceFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('app_index');
        }

        return $this->render('EventOccurenceForm.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
