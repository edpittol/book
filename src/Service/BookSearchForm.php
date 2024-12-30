<?php

namespace App\Service;

use App\Entity\Search;
use App\Form\Type\BookSearchType;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

class BookSearchForm
{
    public function __construct(
        private FormFactoryInterface $formFactory,
    ) {
    }

    /**
     * @return FormInterface<Form>
     */
    public function create(): FormInterface
    {
        $search = new Search();
        $form = $this->formFactory->create(BookSearchType::class, $search);

        return $form;
    }
}
