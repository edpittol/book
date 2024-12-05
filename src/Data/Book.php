<?php

namespace App\Data;

class Book
{
    public function __construct(
        public readonly string $title,
        public readonly array $authors,
        public readonly string $description,
        public readonly bool $isBookmarked,
    )
    {}
}
