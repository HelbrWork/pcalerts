<?php

namespace App\Controller;

use App\Client\AffiseApiClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class TestController extends AbstractController
{
    public function __construct(
        private readonly AffiseApiClient $client,
    ){
    }

    #[Route('/adv', name: 'adv', methods: ['GET'])]
    public function test(): JsonResponse
    {
        return new JsonResponse($this->client->getAdvertisers());
    }
}