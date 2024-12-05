<?php


namespace App\Tests\Acceptance;

use App\Tests\Support\AcceptanceTester;

class BookmarkCest
{
    public function removeBookmark(AcceptanceTester $I)
    {
        $I->amOnPage('/?q=API');
        $I->click('//div[1]/a');

        $I->amOnPage('/bookmarks');
        $I->click('Remove Bookmark');

        $I->waitForElementNotVisible('.book');
        $I->seeNumberOfElements('.book', 0);

        $I->dontSeeInDatabase('bookmark', ['google_books_id' => '6D64DwAAQBAJ']);
    }
}
