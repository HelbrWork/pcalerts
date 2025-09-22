<?php declare(strict_types=1);

namespace App\Client;

use App\Builder\AdvertiserEntityBuilder;
use App\Entity\Offer;
use App\Repository\OfferRepository;
use DateTimeImmutable;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class StreamAffiseApiClient
{

    private const string API_URL = '3.0/stats/custom';

    public function __construct(
        #[Autowire('%affise_domain%')] private string $domain,
        #[Autowire('%affise_apikey%')] private string $apiKey,
        private HttpClientInterface $client,
        private OfferRepository $offerRepository
    ) {
    }

    public function getAll(): void
    {
        $nextPage = 1;
        $data = [];
        while ($nextPage !== null) {
            $response = $this->client->request(
                'GET',
                $this->domain.self::API_URL,
                [
                    'query' => [
                        'limit' => 100,
                        'page' => $nextPage,
                    ],
                    'headers' => [
                        'Accept' => 'application/json',
                        'API-Key' => $this->apiKey,
                    ],
                ]
            );
            $response = $response->toArray();
            array_push($data, ...$response['advertisers']);
            $nextPage = $response['pagination']['next_page'] ?? null;
        }

        $this->advertiserEntityBuilder->build($data);
    }
    private function getGeos()
    {
        /** @var Offer[] $offers */
        $offers = $this->offerRepository->findAll();
        $geos = array_map(static function (Offer $offer) {
            return $offer->getGeo();
        }, $offers);

    }

    private function getParams()
    {
        $dateFrom = (new DateTimeImmutable('-2 years'))->format('Y-m-d H:i:s');
        $dateTo = (new DateTimeImmutable('now'))->format('Y-m-d H:i:s');

    }

}