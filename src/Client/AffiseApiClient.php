<?php declare(strict_types=1);

namespace App\Client;

use App\Entity\Advertiser;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
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
        private LoggerInterface $logger
    ) {
    }

    private function getTotal(): int
    {
        $response = $this->client->request(
            'GET',
            $this->domain.self::API_URL,
            [
                'query' => [
                    'limit' => 1,
                    'page' => 1,
                ],
                'headers' => [
                    'Accept' => 'application/json',
                    'API-Key' => $this->apiKey,
                ],
            ]
        );
        $data = $response->toArray();

        return $data['pagination']['total_count'];
    }

    public function getAdvertisers(): JsonResponse
    {
        $total = $this->getTotal();
        $data = [];
        for ($i = 0; $i < $total / 100; $i++) {
            $response = $this->client->request(
                'GET',
                $this->domain.self::API_URL,
                [
                    'query' => [
                        'limit' => 100,
                        'page' => $i,
                    ],
                    'headers' => [
                        'Accept' => 'application/json',
                        'API-Key' => $this->apiKey,
                    ],
                ]
            );
            $response = $response->toArray();
            array_push($data, ...$response['advertisers']);
        }

        foreach ($data as $item) {
            if (!isset($item['id'], $item['title'], $item['created_at'])) {
                $this->logger->warning('Skipping advertiser', ['item' => $item]);
                continue;
            }
//            $existingAdvertiser = $this
//                ->entityManager
//                ->getRepository(Advertiser::class)
//                ->findOneBy([
//                    'affiseAdvertiserId' => $item['id'],
//                    'affiseManagerId' => $item['manager_obj']['id'],
//                ]);
//
//            if ($existingAdvertiser) {
//                continue;
//            }

            $advertiser = new Advertiser();

            if (!is_array($item['manager_obj'])) {
                $advertiser->setAffiseManagerId('');
            } else {
                $advertiser->setAffiseManagerId($item['manager_obj']['id']);
            }
            $advertiser
                ->setAffiseAdvertiserId($item['id'])
                ->setAffiseTitle($item['title'])
                ->setAffiseCreatedAt(new \DateTimeImmutable($item['created_at']));

            $this->entityManager->persist($advertiser);
        }
        $this->entityManager->flush();

        return new JsonResponse('', 200);
    }
}