<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Bookmark;
use App\Service\BookService;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookmarkController extends AbstractController
{
    public function __construct(
        private readonly BookService $bookService,
    ) {}

    #[Route('/bookmarks', name: 'app_list_bookmarks')]
    public function listBookmarks(EntityManagerInterface $entityManager): Response
    {
        $entityRepository = $entityManager->getRepository(Bookmark::class);
        /** @var Bookmark[] $bookmarks */
        $bookmarks = $entityRepository->findAll();

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
    public function addBookmark(EntityManagerInterface $entityManager, Request $request, string $id, ManagerRegistry $registry): Response
    {
        $bookmark = new Bookmark();
        $bookmark->setGoogleBooksId($id);

        $entityManager->persist($bookmark);
        $entityManager->flush();

        $redirectUrl = $request->headers->get('referer');
        return new RedirectResponse($redirectUrl);
    }

    #[Route('/bookmark/{id}/remove', name: 'app_remove_bookmark')]
    public function removeBookmark(EntityManagerInterface $entityManager, string $id): Response
    {
        $bookmark = $entityManager->getRepository(Bookmark::class)->findOneBy(['google_books_id' => $id]);

        $entityManager->remove($bookmark);
        $entityManager->flush();

        return $this->redirectToRoute('app_list_bookmarks');
    }
}
