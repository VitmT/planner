<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\LoginType;

class LoginController extends AbstractController
{   
    #[Route('/login', name: 'login')]
    public function Login(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(LoginType::class, []);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            
        }
        if ($user !== null) {

        }

       # return $this->redirectToRoute("app_index");

        return $this->render('login.html.twig', [
            "form" => $form,
        ]);
    }
    
    #[Route('/logout', name: 'logout')]
    public function Logout(): void
    {

    }
}
