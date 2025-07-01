<?php declare(strict_types=1);

namespace App\Client;

use App\Builder\UserEntityBuilder;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final readonly class UserAffiseApiClient implements ApiClientInterface
{
    private const string API_URL = '/3.0/admin/users';

    public function __construct(
        #[Autowire('%affise_domain%')] private string $domain,
        #[Autowire('%affise_apikey%')] private string $apiKey,
        private HttpClientInterface $client,
        private UserEntityBuilder $userEntityBuilder,
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
            array_push($data, ...$response['users']);
            $nextPage = $response['pagination']['next_page'] ?? null;
        }
        $this->userEntityBuilder->build($data);
    }
}