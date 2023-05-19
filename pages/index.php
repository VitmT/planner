<?php

use App\Form\IndexType;

return [
    "template" => "index.html.twig",
    "events" => [
        ["editLink" => "#", "place" => "Nové Sedlo", "date" => date('y.m.d'), "time" => date('h:i')],
        ["editLink" => "#", "place" => "Chodov", "date" => date('y.m.d'), "time" => date('h:i')],
        ["editLink" => "#", "place" => "Ostrov", "date" => date('y.m.d'), "time" => date('h:i')],
        ["editLink" => "#", "place" => "Stará Role", "date" => date('y.m.d'), "time" => date('h:i')],
        ["editLink" => "#", "place" => "Sokolov", "date" => date('y.m.d'), "time" => date('h:i')],
    ],
];
