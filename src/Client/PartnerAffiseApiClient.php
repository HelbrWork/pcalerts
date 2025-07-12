<?php

namespace App\Client;

use App\Builder\PartnerEntityBuilder;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use App\Client\ApiClientInterface;

class PartnerAffiseApiClient implements ApiClientInterface
{
    public function __construct(
        #[Autowire('%affise_domain%')] private string $domain,
        #[Autowire('%affise_apikey%')] private string $apiKey,
        private HttpClientInterface $client,
        private PartnerEntityBuilder $builder
    ) {
    }

    public function getAll(): void
    {
        $nextPage = 1;
        $partners = [];

        while ($nextPage !== null) {
            $response = $this->client->request(
                'GET',
                "$this->domain/3.0/admin/partners",
                [
                    'query' => [
                        'limit' => 200,
                        'page' => $nextPage,
                    ],
                    'headers' => [
                        'Accept' => 'application/json',
                        'API-Key' => $this->apiKey,
                    ],
                ]
            );

            $data = $response->toArray(false);
            array_push($partners, ...($data['partners'] ?? []));
            $nextPage = $data['pagination']['next_page'] ?? null;
        }

        $this->builder->build($partners);
    }
}
