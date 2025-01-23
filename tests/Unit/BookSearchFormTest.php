<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Entity\Search;
use App\Form\Type\BookSearchType;
use App\Service\BookSearchForm;
use Codeception\Test\Unit;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

final class BookSearchFormTest extends Unit
{
    public function testConstructor(): void
    {
        $formFactoryMock = $this->createMock(FormFactoryInterface::class);

        $bookSearchForm = new BookSearchForm($formFactoryMock);
        $this->assertInstanceOf(BookSearchForm::class, $bookSearchForm);
    }

    public function testCreate(): void
    {
        $formFactoryMock = $this->createMock(FormFactoryInterface::class);
        $search = new Search();
        $formMock = $this->createMock(FormInterface::class);

        $formFactoryMock
            ->expects($this->once())
            ->method('create')
            ->with(BookSearchType::class, $search)
            ->willReturn($formMock);

        $bookSearchForm = new BookSearchForm($formFactoryMock);
        $form = $bookSearchForm->create();

        $this->assertInstanceOf(FormInterface::class, $form);
    }
}
