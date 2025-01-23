<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Entity\Search;
use App\Form\Type\BookSearchType;
use Symfony\Component\Form\Test\TypeTestCase;

final class BookSearchTypeTest extends TypeTestCase
{
    public function testSubmitValidData(): void
    {
        $formData = [
            'query' => 'API',
        ];

        $model = new Search();

        $form = $this->factory->create(BookSearchType::class, $model);

        $expected = new Search();
        $expected->setQuery('API');

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($expected, $model);
    }
}
