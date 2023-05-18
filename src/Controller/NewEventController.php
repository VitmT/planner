<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\EventOccurenceFormType;

class NewEventController extends AbstractController
{
    /**
     * @Route("/new-eventt", name="new-event")
     */
    public function Login(): Response
    {
        return $this->render('EventOccurenceForm.html.twig', [
            "form" => $this->createForm(EventOccurenceFormType::class,[]),
        ]);
    }
}