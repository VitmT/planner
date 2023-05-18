<?php

use App\Form\IndexType;

return [
    "template" => "index.html.twig",
    "form" => $this->createForm(IndexType::class,[]),
];