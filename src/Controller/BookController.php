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
            'https://www.googleapis.com/books/v1/volumes', [
                'query' => [
                    'q' => 'api',
                ],
            ]
        );
        $content = $response->toArray();

        $responseText = '';

        foreach($content['items'] as $item) {
            $title = $item['volumeInfo']['title'];
            $responseText .= "<p>$title</p>";
        }

        return new Response($responseText);
    }
}
