<?php

namespace App\Infrastructure\Services\CryptoCurrency;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CryptoPriceFetcher implements CryptoPriceFetcherInterface
{
    private const API_URL = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest';

    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly string $apiKey,
    ) {
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function fetch(string $base, string $quote): array
    {
        $response = $this->httpClient->request('GET', self::API_URL, [
            'headers' => [
                'X-CMC_PRO_API_KEY' => $this->apiKey,
            ],
            'query' => [
                'symbol' => $base,
                'convert' => $quote,
            ],
        ]);

        return $response->toArray();
    }
}
