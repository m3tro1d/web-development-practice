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
}
