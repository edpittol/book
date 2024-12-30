<?php

namespace App\Controller;

use App\Entity\Search;
use App\Form\Type\BookSearchType;
use App\Service\BookService;
use App\Service\GoogleBooksClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookController extends AbstractController
{
    public function __construct(
        private GoogleBooksClient $client,
        private BookService $bookService,
    ) {
    }

    #[Route('/')]
    public function list(Request $request): Response
    {
        $search = new Search();
        $form = $this->createForm(BookSearchType::class, $search);

        $form->handleRequest($request);
        $search = $form->getData();
        $query = $search->getQuery();
        if ($form->isSubmitted() && $form->isValid()) {
            $volumes = $this->client->searchBooks($query);

            $books = [];
            foreach ($volumes as $volume) {
                $books[] = $this->bookService->loadBook($volume->id, $volume);
            }
        }

        return $this->render('book/home.html.twig', [
            'books' => $books ?? [],
            'form' => $form,
            'query' => $search->getQuery(),
        ]);
    }
}
