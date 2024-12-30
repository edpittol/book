<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Service\GoogleBooksClient;
use App\Tests\Support\FunctionalTester;

class GoogleBooksClientCest
{
    public function searchBooks(FunctionalTester $I): void
    {
        /** @var GoogleBooksClient $service */
        $service = $I->grabService(GoogleBooksClient::class);
        $volumes = $service->searchBooks('API');

        $I->assertEquals('API Design for C++', $volumes[2]->title);
        $I->assertEquals('Martin Reddy', $volumes[2]->authors[0]);
        $I->assertStringStartsWith('API Design for C++ provides a comprehensive discussion', strip_tags($volumes[2]->description));
    }

    public function getBookDetails(FunctionalTester $I): void
    {
        /** @var GoogleBooksClient $service */
        $service = $I->grabService(GoogleBooksClient::class);
        $volume = $service->getBookDetails('6D64DwAAQBAJ');

        $I->assertEquals('API Architecture', $volume->title);
        $I->assertEquals('Matthias Biehl', $volume->authors[0]);
        $I->assertStringStartsWith('Looking for the big picture of building APIs', strip_tags($volume->description));
    }
}
