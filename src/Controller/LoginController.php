<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\LoginType;

class LoginController extends AbstractController
{   #[Route('/login', name: 'login')]
    public function Login(): Response
    {
        return $this->render('login.html.twig', [
            "form" => $this->createForm(LoginType::class,[]),
        ]);
    }
}