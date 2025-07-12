<?php

namespace App\Controller;

use App\Client\OfferAffiseApiClient;
use App\Entity\Partner;
use App\Client\PartnerAffiseApiClient;
use App\Client\AdvertiserAffiseApiClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class TestController extends AbstractController
{
    public function __construct(
        private readonly AdvertiserAffiseApiClient $AdvertiserAffiseApiClient,
    ){
    }

    #[Route('/adv', name: 'adv', methods: ['GET'])]
    public function test(): JsonResponse
    {
        $this->AdvertiserAffiseApiClient->getAll();

        return new JsonResponse('done', 200);
    }
}
