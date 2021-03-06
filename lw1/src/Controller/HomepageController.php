<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomepageController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('homepage/index.html.twig');
    }

    public function movies(): Response
    {
        return $this->render('homepage/movies.html.twig');
    }

    public function lucky(): Response
    {
        $number = random_int(0, 100);
        return $this->render('homepage/lucky.html.twig', [
            'number' => $number
        ]);
    }

    public function useragent(Request $request): Response
    {
        return $this->render('homepage/useragent.html.twig', [
            'headers' => $request->headers->all()
        ]);
    }
}
