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
            'title' => 'API'
        ]);

        $I->seeNumberOfElements('p', 10);
        $I->see('API Design for C++');
    }
}
