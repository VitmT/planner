<?php

use App\Form\LoginType;

return [
    "template" => "login.html.twig",
    "form" => $this->createForm(LoginType::class,[]),
];
