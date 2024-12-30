<?php

namespace App\Tests\Functional;

use App\Tests\Support\FunctionalTester;

class HomeCest
{
    public function tryToTest(FunctionalTester $I): void
    {
        $I->amOnPage('/');
        $I->dontSeeElement('p');

        $I->dontSee('Internal Server Error');
    }
}
