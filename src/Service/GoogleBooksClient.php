<?php

namespace App\Service;

use App\Adapter\VolumeAdapter;
use App\Data\Volume;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GoogleBooksClient
{
    public function __construct(
        private HttpClientInterface $client,
        private VolumeAdapter $volumeAdapter,
        private string $googleBooksApiBaseUrl,
        private string $googleBooksApiKey,
    ) {
    }

    public function searchBooks(string $query): array
    {
        $response = $this->client->request('GET', $this->googleBooksApiBaseUrl.'volumes', [
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
        $response = $this->client->request('GET', $this->googleBooksApiBaseUrl.'volumes/'.$googleBooksId, [
            'query' => [
                'key' => $this->googleBooksApiKey,
            ],
        ]);

        $item = $response->toArray();
        $volume = $this->volumeAdapter->fromGoogleClientItem($item);

        return $volume;
    }
}
