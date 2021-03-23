<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Module\IndexFavoritesProvider;

class HomepageController extends AbstractController
{
    public function index(): Response
    {
        $provider = new IndexFavoritesProvider(5);
        $favorites = $provider->getDatasetsByQueries('Programming', 'The Clone Wars', 'Dream Theater');
        return $this->render('homepage/index.html.twig', [
            'favorites' => $favorites
        ]);
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

    public function headers(Request $request): Response
    {
        return $this->render('homepage/headers.html.twig', [
            'headers' => $request->headers->all()
        ]);
    }
}
