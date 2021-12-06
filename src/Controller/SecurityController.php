<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController{

    #[Route('/registration', name: 'security_registration')]
    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hash): Response{

        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            $user->setPassword(
                $hash->hashPassword(
                    $user,
                    $form->get('password_not_hashed')->getData()
                )
            );
            $user->setRoles(["ROLE_ADMIN"]);
            
            $manager->persist($user);
            $manager->flush();
        }
        
        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/login', name: 'security_login')]
    public function login(): Response{

        $form = $this->createForm(LoginType::class);

        return $this->render('security/login.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/logout', name: 'security_logout')]
    public function logout(){}
}
