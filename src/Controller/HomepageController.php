<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Module\GoogleImagesProvider;

class HomepageController extends AbstractController
{
    private const INDEX_IMAGES_AMOUNT = 5;

    public function index(): Response
    {
        $keywords = ['Programming', 'The Clone Wars', 'Dream Theater'];
        $favorites = [];
        foreach ($keywords as $keyword)
        {
            $favorites[$keyword] = GoogleImagesProvider::getImagesURLsByKeyword($keyword, self::INDEX_IMAGES_AMOUNT);
        }
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
