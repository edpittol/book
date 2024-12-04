<?php


namespace App\Tests\Functional;

use App\Entity\Bookmark;
use App\Tests\Support\FunctionalTester;

class BookmarkCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function bookmarkABook(FunctionalTester $I)
    {
        $I->amOnPage('/?q=API');

        $bookmarkXPath = '//html/body/div[1]';
        $bookmarkId = $I->grabAttributeFrom($bookmarkXPath, 'id');
        $I->makeHtmlSnapshot();
        $I->click('Bookmark', $bookmarkXPath . '/a');

        $I->seeInRepository(Bookmark::class, ['google_books_id' => $bookmarkId]);
    }

    public function listBookmarks(FunctionalTester $I)
    {
        $I->haveInRepository(Bookmark::class, ['google_books_id' => '6D64DwAAQBAJ']);

        $I->amOnPage('/bookmarks');
        $I->seeNumberOfElements('.book', 1);
        $I->see('Bookmarks', 'h1');
        $I->see('API Architecture', '.title');
        $I->see('Author: Matthias Biehl', '.author');
        $I->see('Looking for the big picture of building APIs', '.description');
    }
}
