<?php

namespace App\Service;

use App\Data\Book;
use App\Data\Volume;
use App\Entity\Bookmark;
use Doctrine\ORM\EntityManagerInterface;

class BookService
{
    public function __construct(
        private GoogleBooksClient $client,
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function loadBook(string $id, ?Volume $volume = null): Book
    {
        if (is_null($volume)) {
            $volume = $this->client->getBookDetails($id);
        }

        $repository = $this->entityManager->getRepository(Bookmark::class);
        $bookmark = $repository->findOneBy(['google_books_id' => $id]);
        $isBookmarked = !is_null($bookmark);

        return new Book($volume, $isBookmarked);
    }
}
