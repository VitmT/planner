<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\EventOccurenceFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\ReccuringEventOccurence as RecurringEventOccurence;

class NewEventController extends AbstractController
{
    #[Route('/new-event', name: 'new-event')]
    public function Login(?int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($id === null) {
            $recurringEventOccurence = new RecurringEventOccurence();
        } else {
            $recurringEventOccurence = $this->getRepository(RecurringEventOccurence::class)->find($id);
        }
        //$reccuringEventOccurence = [];//new ReccuringEvent();
                
        $form = $this->createForm(EventOccurenceFormType::class);

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
}
