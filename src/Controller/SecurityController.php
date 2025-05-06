<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login_check', name: 'login_check')]
    public function loginCheckAction(Security $security): void
    {
        /*
         * Check user
         */
    }

    #[Route('/login', name: 'login', methods: ['GET', 'POST'])]
    public function loginAction(Request $request, Security $security, AuthenticationUtils $helper): Response
    {
        return $this->render('login/login.html.twig', [
            'last_username' => $helper->getLastUsername(),
            'error' => $helper->getLastAuthenticationError(),
        ]);
    }

}