<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BookController extends AbstractController
{
    public function __construct(
        private HttpClientInterface $client,
    ) {
    }

    #[Route('/')]
    public function list(): Response
    {
        $response = $this->client->request(
            'GET',
            $this->getParameter('app.google_books_api.base_url') . 'volumes', [
                'query' => [
                    'q' => 'api',
                    'key' => $this->getParameter('app.google_books_api.key')
                ],
            ]
        );

        $content = $response->toArray();

        return $this->render('book/home.html.twig', [
            'books' => $content['items'] ?? []
        ]);
    }
}
