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
}
