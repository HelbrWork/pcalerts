<?php declare(strict_types=1);

namespace App\Controller;

use App\Service\UserAdvertiserConnector;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class TestController extends AbstractController
{
    public function __construct(
        private readonly UserAdvertiserConnector $connector,
    ) {
    }

    #[Route('/adv', name: 'adv', methods: ['GET'])]
    public function test(): JsonResponse
    {
        $this->connector->connect();

        return new JsonResponse('done', 200);
    }
}
