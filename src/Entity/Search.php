<?php

declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Search
{
    #[Assert\NotBlank]
    protected string $query = '';

    public function getQuery(): string
    {
        return $this->query;
    }

    public function setQuery(string $query): void
    {
        $this->query = $query;
    }
}
