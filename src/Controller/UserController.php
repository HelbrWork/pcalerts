<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    public function __construct(private UserRepository $userRepository, private EntityManagerInterface $entityManager)
    {
    }

    #[Route('/users', name: 'users', methods: ['GET'])]
    public function index(): Response
    {
        $allUsers = $this->userRepository->findAll();

        return $this->render('user/index.html.twig', [
            'users' => $allUsers,
        ]);
    }

    #[Route('/users/{id}/activate', name: 'app_user_toggle_active', methods: ['POST'])]
    public function activate(User $user): Response
    {
        $user->setActive(!$user->isActive());
        $this->entityManager->flush();

        $this->addFlash('success', sprintf(
            'User "%s" is now %s',
            $user->getId(),
            $user->isActive() ? 'active' : 'inactive'
        ));

        return $this->redirectToRoute('users');
    }
}
