<?php

namespace App\Tests\Functional;

use App\Entity\Bookmark;
use App\Service\BookService;
use App\Tests\Support\FunctionalTester;

class BookServiceCest
{
    public function loadBook(FunctionalTester $I)
    {
        $googleBooksId = '6D64DwAAQBAJ';
        $I->haveInRepository(Bookmark::class, ['google_books_id' => $googleBooksId]);

        /** @var BookService $service */
        $service = $I->grabService(BookService::class);
        $book = $service->loadBook($googleBooksId);
        
        $I->assertEquals('API Architecture', $book->title);
        $I->assertEquals('Matthias Biehl', $book->authors[0]);
        $I->assertStringStartsWith('Looking for the big picture of building APIs', strip_tags($book->description));
        $I->assertTrue($book->isBookmarked);
    }
}
