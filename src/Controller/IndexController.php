<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\IndexType;

class IndexController extends AbstractController
{
    #[Route('/index', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('index.html.twig',[
            "events" => [
                ["editLink" => "#", "place" => "Nové Sedlo", "date" => date('y.m.d'), "time" => date('h:i')],
                ["editLink" => "#", "place" => "Chodov", "date" => date('y.m.d'), "time" => date('h:i')],
                ["editLink" => "#", "place" => "Ostrov", "date" => date('y.m.d'), "time" => date('h:i')],
                ["editLink" => "#", "place" => "Stará Role", "date" => date('y.m.d'), "time" => date('h:i')],
                ["editLink" => "#", "place" => "Sokolov", "date" => date('y.m.d'), "time" => date('h:i')],
            ],
        ]);

    }
}
