<?php

namespace App\Controller;

use App\Client\AffiseApiClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TestController extends AbstractController
{
    public function __construct(
        private AffiseApiClient $client,
    ){
    }

    #[Route('/total', name: 'total', methods: ['GET'])]
    public function test()
    {
        return new JsonResponse($this->client->getTotal());
    }


}