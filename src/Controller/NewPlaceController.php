<?php

namespace App\Controller;

use App\Entity\ReccuringEvent;
use App\Form\NewPlaceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewPlaceController extends AbstractController
{
    #[Route('/new-place', name: 'new_place')]
    #[Route('/edit-place/{id}', name: 'edit_place')]
    public function newPlace(Request $request, EntityManagerInterface $em, ReccuringEvent $event = null): Response
    {
        if ($event === null) {
            $event = new ReccuringEvent();
        }

        $form = $this->createForm(NewPlaceType::class, $event);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('event-list');
        }

        return $this->render('NewPlace.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/delete-place/{id}', name: 'delete_place')] // Přidána nová routa pro smazání místa
    public function deletePlace(EntityManagerInterface $em, ReccuringEvent $event): Response
    {
        if ($event !== null) {
            $em->remove($event);
            $em->flush();
        }
        return $this->redirectToRoute('event-list');
    }
}
