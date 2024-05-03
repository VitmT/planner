<?php

namespace App\Controller;

use App\Repository\ReccuringEventOccurenceRepository;
use App\Repository\ReccuringEventRepository;
use App\Entity\ReccuringEvent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends AbstractController
{
    #[Route('', name: 'app_index')]
    public function index(ReccuringEventOccurenceRepository $reccuringEventOccurenceRepository, ReccuringEventRepository $reccuringEventRepository, Request $request): Response
    {
        //$reccuringEventId = $reccuringEventRepository->find($id);
        //if (!$reccuringEventId) {
        //    throw $this->createNotFoundException('Recurring event not found.');
        //}
        $reccuringEventOccurences = $reccuringEventOccurenceRepository->findAll();
       // dd( $reccuringEventOccurences[0]->getReccuringEvent());
        return $this->render('index.html.twig',[
            "occurences" => $reccuringEventOccurences
        ]);

    }
}
