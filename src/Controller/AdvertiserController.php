<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\Advertiser;
use App\Repository\AdvertiserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdvertiserController extends AbstractController
{
    public function __construct(
        private AdvertiserRepository $advertiserRepository,
        private EntityManagerInterface $entityManager,
    ) {}

    #[Route('/advertisers', name: 'advertisers', methods: ['GET'])]
    public function index(): Response
    {
        $advertisers = $this->advertiserRepository->findAll();

        $data = array_map(function (Advertiser $advertiser) {
            return [
                'id' => $advertiser->getId(),
                'active' => $advertiser->isActive(),
                'user_id' => $advertiser->getUser()?->getId(),
            ];
        }, $advertisers);

        return new JsonResponse($data);
    }

    #[Route('/advertisers/{id}/activate', name: 'app_advertiser_toggle_active', methods: ['POST'])]
    public function activate(Advertiser $advertiser): Response
    {
        $advertiser->setActive(!$advertiser->isActive());
        $this->entityManager->flush();

        $message = sprintf(
            'Advertiser "%s" is now %s',
            $advertiser->getId(),
            $advertiser->isActive() ? 'active' : 'inactive'
        );

        return new JsonResponse(['message' => $message]);
    }
}
