<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\BookmarkRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookmarkRepository::class)]
#[ORM\UniqueConstraint(name: 'google_books_id', columns: ['google_books_id'])]
class Bookmark
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 12)]
    private string $google_books_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGoogleBooksId(): ?string
    {
        return $this->google_books_id;
    }

    public function setGoogleBooksId(string $google_books_id): static
    {
        $this->google_books_id = $google_books_id;

        return $this;
    }
}
