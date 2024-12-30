<?php

declare(strict_types=1);

namespace App\Data;

class Book
{
    public function __construct(
        public readonly Volume $volume,
        public readonly bool $isBookmarked,
    ) {
    }
}
