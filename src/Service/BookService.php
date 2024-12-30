<?php

declare(strict_types=1);

namespace App\Service;

use App\Data\Book;
use App\Data\Volume;
use App\Entity\Bookmark;
use Doctrine\ORM\EntityManagerInterface;

class BookService
{
    public function __construct(
        private readonly GoogleBooksClient $googleBooksClient,
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    public function loadBook(string $id, ?Volume $volume = null): Book
    {
        if (is_null($volume)) {
            $volume = $this->googleBooksClient->getBookDetails($id);
        }

        $entityRepository = $this->entityManager->getRepository(Bookmark::class);
        $bookmark = $entityRepository->findOneBy(['google_books_id' => $id]);
        $isBookmarked = !is_null($bookmark);

        return new Book($volume, $isBookmarked);
    }
}
