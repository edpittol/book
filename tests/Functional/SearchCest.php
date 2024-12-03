<?php


namespace App\Tests\Functional;

use App\Tests\Support\FunctionalTester;

class SearchCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function tryToTest(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->submitForm('form', [
            'q' => 'API'
        ]);

        $I->seeNumberOfElements('h2.title', 10);
        $I->see('Search results for: API');
        $I->see('API Design for C++', '.title');
        $I->see('Author: Martin Reddy', '.author');
        $I->see('API Design for C++ provides a comprehensive discussion', '.description');
    }
}
