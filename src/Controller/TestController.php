<?php

namespace App\Controller;

use App\Client\AdvertiserAffiseApiClient;
use App\Client\UserAffiseApiClient;
use App\Connector\UserAdvertiserApiConnector;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class TestController extends AbstractController
{
    public function __construct(
        private readonly UserAdvertiserApiConnector $connector,
    ){
    }

    #[Route('/adv', name: 'adv', methods: ['GET'])]
    public function test(): JsonResponse
    {
        $this->connector->connect();
        return new JsonResponse('',200);
    }
}