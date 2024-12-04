<?php

namespace App\Controller;

use App\Entity\Bookmark;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookmarkController extends AbstractController
{
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
