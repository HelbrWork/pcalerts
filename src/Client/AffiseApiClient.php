<?php declare(strict_types=1);

namespace App\Client;

use App\Entity\Advertiser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final readonly class AffiseApiClient
{
    private const string API_URL = '/3.0/admin/advertisers';

    public function __construct(
        #[Autowire('%affise_domain%')] private string $domain,
        #[Autowire('%affise_apikey%')] private string $apiKey,
        private HttpClientInterface $client,
        private EntityManagerInterface $entityManager,
    ){
    }

    private function getTotal(): int
    {
        $response = $this->client->request(
            'GET', $this->domain. self::API_URL,
            [
                'query' => [
                    'limit' => 1,
                    'page' => 1,
                ],
                'headers' => [
                    'Accept' => 'application/json',
                    'API-Key' => $this->apiKey,
                ]
            ]
        );
        $data = $response->toArray();
        return $data['pagination']['total_count'];
    }

    public function getAdvertisers(?int $page = null, ?int $perPage = null): JsonResponse
    {
        $total = $this->getTotal();
        $data = [];
        for ($i = 0; $i < $total/100 ; $i++) {
            $response = $this->client->request(
                'GET', $this->domain. self::API_URL,
                [
                    'query' => [
                        'limit' => 100,
                        'page' => $i,
                    ],
                    'headers' => [
                        'Accept' => 'application/json',
                        'API-Key' => $this->apiKey,
                    ]
                ]
            );
            $response = $response->toArray();
            $data[$i] = array_merge($data,$response['advertisers']);
        }
        $data=array_merge(...$data);
        foreach ($data as $item) {
            $advertiser = new Advertiser();
            $advertiser->setAffiseAdvertiserId($item['id']);
            //$advertiser->setAffiseManagerId($item['manager_obj']['id']);
            $advertiser->setAffiseTitle($item['title']);
            $advertiser->setAffiseCreatedAt(new \DateTimeImmutable($item['created_at']));
            $this->entityManager->persist($advertiser);
        }
        $this->entityManager->flush();
        return new JsonResponse('',200);
    }
}