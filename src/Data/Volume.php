<?php

namespace App\Data;

class Volume
{
    public function __construct(
        public readonly string $id,
        public readonly string $title,
        public readonly array $authors,
        public readonly string $description,
    ) {
    }
}
