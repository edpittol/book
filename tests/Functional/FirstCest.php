<?php


namespace App\Tests\Functional;

use App\Tests\Support\FunctionalTester;

class FirstCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->seeNumberOfElements('p', 10);
    }
}
