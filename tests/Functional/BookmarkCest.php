<?php

namespace App\Tests\Functional;

use App\Entity\Bookmark;
use App\Tests\Support\FunctionalTester;

class BookmarkCest
{
    public function bookmarkABook(FunctionalTester $I): void
    {
        $I->amOnPage('/');
        $I->submitSymfonyForm('book_search', [
            '[query]' => 'API',
        ]);

        $bookmarkXPath = '//html/body/div[1]';
        $bookmarkId = $I->grabAttributeFrom($bookmarkXPath, 'id');
        $I->makeHtmlSnapshot();
        $I->click('Bookmark', $bookmarkXPath.'/a');

        $I->seeInRepository(Bookmark::class, ['google_books_id' => $bookmarkId]);
    }

    public function listBookmarks(FunctionalTester $I): void
    {
        $I->haveInRepository(Bookmark::class, ['google_books_id' => '6D64DwAAQBAJ']);

        $I->amOnPage('/bookmarks');
        $I->seeNumberOfElements('.book', 1);
        $I->see('Bookmarks', 'h1');
        $I->see('API Architecture', '.title');
        $I->see('Author: Matthias Biehl', '.author');
        $I->see('Looking for the big picture of building APIs', '.description');
    }

    public function removeBookmark(FunctionalTester $I): void
    {
        $I->haveInRepository(Bookmark::class, ['google_books_id' => '6D64DwAAQBAJ']);

        $I->amOnPage('/bookmarks');
        $I->click('Remove Bookmark');
        $I->seeNumberOfElements('.book', 0);
    }
}
