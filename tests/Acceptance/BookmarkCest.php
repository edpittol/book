<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use App\Tests\Support\AcceptanceTester;

class BookmarkCest
{
    public function removeBookmark(AcceptanceTester $I): void
    {
        $I->amOnPage('/');

        $I->submitForm('//form[@name="book_search"]', [
            'book_search[query]' => 'API',
        ]);

        $I->waitForElement('//div[1]/a', 2);
        $I->click('//div[1]/a');

        $I->amOnPage('/bookmarks');
        $I->click('Remove Bookmark');

        $I->waitForElementNotVisible('.book');
        $I->seeNumberOfElements('.book', 0);

        $I->dontSeeInDatabase('bookmark', ['google_books_id' => '6D64DwAAQBAJ']);
    }
}
