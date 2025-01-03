<?php

declare(strict_types=1);

namespace App\Service;

use App\Adapter\VolumeAdapter;
use App\Data\Volume;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GoogleBooksClient
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly VolumeAdapter $volumeAdapter,
        private readonly string $googleBooksApiBaseUrl,
        private readonly string $googleBooksApiKey,
    ) {
    }

    /**
     * @return Volume[]
     */
    public function searchBooks(string $query): array
    {
        $response = $this->httpClient->request('GET', $this->googleBooksApiBaseUrl.'volumes', [
            'query' => [
                'q' => $query,
                'key' => $this->googleBooksApiKey,
            ],
        ]);

        $responseData = $response->toArray();

        $volumes = [];
        foreach ($responseData['items'] as $item) {
            $volumes[] = $this->volumeAdapter->fromGoogleClientItem($item);
        }

        return $volumes;
    }

    public function getBookDetails(string $googleBooksId): Volume
    {
        $response = $this->httpClient->request('GET', $this->googleBooksApiBaseUrl.'volumes/'.$googleBooksId, [
            'query' => [
                'key' => $this->googleBooksApiKey,
            ],
        ]);

        $item = $response->toArray();

        return $this->volumeAdapter->fromGoogleClientItem($item);
    }
}
