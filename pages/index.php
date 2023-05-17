<?php
use App\Form\EventOccurenceFormType;
return [
    "template" => "EventOccurenceForm.html.twig",
    "form" => $this->createForm(EventOccurenceFormType::class, []),
];