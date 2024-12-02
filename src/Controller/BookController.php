<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookController
{
    #[Route('/')]
    public function list(): Response
    {
        return new Response('I am ready!');
    }
}
