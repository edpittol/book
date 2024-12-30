<?php

namespace App\Controller;

use App\Entity\Bookmark;
use App\Service\BookService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookmarkController extends AbstractController
{
    public function __construct(
        private BookService $bookService,
    ) {
    }

    #[Route('/bookmarks', name: 'app_list_bookmarks')]
    public function listBookmarks(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Bookmark::class);
        /** @var Bookmark[] $bookmarks */
        $bookmarks = $repository->findAll();

        $books = [];
        foreach ($bookmarks as $bookmark) {
            $id = $bookmark->getGoogleBooksId();
            $books[] = $this->bookService->loadBook($id);
        }

        return $this->render('bookmark/list.html.twig', [
            'books' => $books,
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

    #[Route('/bookmark/{id}/remove', name: 'app_remove_bookmark')]
    public function removeBookmark(EntityManagerInterface $entityManager, Request $request, string $id): Response
    {
        $bookmark = $entityManager->getRepository(Bookmark::class)->findOneBy(['google_books_id' => $id]);

        $entityManager->remove($bookmark);
        $entityManager->flush();

        return $this->redirectToRoute('app_list_bookmarks');
    }
}
