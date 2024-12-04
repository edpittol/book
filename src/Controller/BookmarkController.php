<?php

namespace App\Controller;

use App\Entity\Bookmark;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BookmarkController extends AbstractController
{
    public function __construct(
        private HttpClientInterface $client,
    ) {
    }

    #[Route('/bookmarks', name: 'app_list_bookmarks')]
    public function listBookmarks(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Bookmark::class);
        $bookmarks = $repository->findAll();

        $books = [];
        foreach ($bookmarks as $bookmark) {
            $response = $this->client->request(
                'GET',
                $this->getParameter('app.google_books_api.base_url') . 'volumes/' . $bookmark->getGoogleBooksId()
            );

            $books[] = $response->toArray();
        }
        
        return $this->render('bookmark/list.html.twig', [
            'books' => $books
        ]);
    }

    #[Route('/bookmark/{id}', name: 'app_add_bookmark')]
    public function addBookmark(EntityManagerInterface $entityManager, Request $request, string $id): Response
    {
        try {
            $bookmark = new Bookmark();
            $bookmark->setGoogleBooksId($id);
    
            $entityManager->persist($bookmark);
            $entityManager->flush();
        } finally {
            $referer = $request->headers->get('referer');
            return new RedirectResponse($referer);
        }
    }
}
