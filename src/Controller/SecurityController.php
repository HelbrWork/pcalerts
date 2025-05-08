<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/logout', name: 'logout')]
    public function logout(): void
    {
    }

    #[Route('/login', name: 'login', methods: ['GET', 'POST'])]
    public function loginAction(AuthenticationUtils $helper): Response
    {
        return $this->render('login/login.html.twig', [
            'last_username' => $helper->getLastUsername(),
            'error' => $helper->getLastAuthenticationError(),
        ]);
    }
}