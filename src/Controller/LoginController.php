<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\LoginType;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{   
    #[Route('/login', name: 'login')]
    public function Login(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(LoginType::class, []);
        $form->handleRequest($request);

        if ($this->getUser()) {
            return $this->redirectToRoute('app_index'); 
        }

        return $this->render('login.html.twig', [
            "form" => $form->createView(),
            "last_username" => $lastUsername,
            "error" => $error,
        ]);
    }
    
    #[Route('/logout', name: 'logout')]
    public function Logout(): void
    {

    }
}
