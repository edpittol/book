<?php


namespace App\Tests\Functional;

use App\Tests\Support\FunctionalTester;

class HomeCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function tryToTest(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->dontSeeElement('p');

        $I->dontSee('Internal Server Error');
    }
}
