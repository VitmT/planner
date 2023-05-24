<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventOccurenceListController extends AbstractController
{
    #[Route('/event-list', name: 'event-list')]
    public function eventoccurencelist(): Response
    {
        return $this->render('EventOccurenceList.html.twig',[
            "reccuringEventOccurences"=>[
                ["editLink" => "#", "place" => "Nové Sedlo"],
                ["editLink" => "#", "place" => "Chodov"],
                ["editLink" => "#", "place" => "Ostrov"],
                ["editLink" => "#", "place" => "Stará Role"],
            ],

        ]);
        
    }
}
