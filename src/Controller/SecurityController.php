<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController{

    #[Route('/login', name: 'login')]
    public function login(): Response{
        return $this->render('security/login.html.twig');
    }

    #[Route('/registration', name: 'registration')]
    public function registration(): Response{
        return $this->render('security/registration.html.twig');
    }
}
