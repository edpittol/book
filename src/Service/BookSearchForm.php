<?php

namespace App\Service;

use App\Entity\Search;
use App\Form\Type\BookSearchType;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactoryInterface;

class BookSearchForm
{
    public function __construct(
        private FormFactoryInterface $formFactory,
    ) {
    }

    public function create(): Form
    {
        $search = new Search();
        $form = $this->formFactory->create(BookSearchType::class, $search);

        return $form;
    }
}
