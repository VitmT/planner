<?php

namespace App\Controller;

use App\Repository\ReccuringEventOccurenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('', name: 'app_index')]
    public function index(ReccuringEventOccurenceRepository $reccuringEventOccurenceRepository): Response
    {
        $reccuringEventOccurences = $reccuringEventOccurenceRepository->findAll();
       // dd( $reccuringEventOccurences[0]->getReccuringEvent());
        return $this->render('index.html.twig',[
            "occurences" => $reccuringEventOccurences
        ]);

    }
}
