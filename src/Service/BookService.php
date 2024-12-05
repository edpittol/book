<?php

namespace App\Service;

use App\Data\Book;
use App\Entity\Bookmark;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BookService
{
    public function __construct(
        private HttpClientInterface $client,
        private EntityManagerInterface $entityManager,
        private string $googleBooksApiBaseUrl
    ) {
    }

    public function loadBook(string $id): Book {
        $response = $this->client->request(
            'GET',
            $this->googleBooksApiBaseUrl . 'volumes/' . $id
        );
        
        $responseData = $response->toArray();

        $repository = $this->entityManager->getRepository(Bookmark::class);
        $bookmark = $repository->findOneBy(['google_books_id' => $id]);
        $isBookmarked = !is_null($bookmark);

        return new Book(
            $responseData['volumeInfo']['title'],
            $responseData['volumeInfo']['authors'],
            $responseData['volumeInfo']['description'],
            $isBookmarked
        );
    }
}
