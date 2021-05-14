<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Module\AboutMe\App\HobbyService;
use App\View\AboutMe\AboutMePageView;

class AboutMeController extends AbstractController
{
    public function aboutMePage(HobbyService $hs): Response
    {
        $view = new AboutMePageView($hs->getHobbies());
        return $this->render('about_me/index.html.twig', $view->buildParams());
    }

    public function updateImages(HobbyService $hs, Request $request): Response
    {
        $hs->updateHobbies($request->request->get('keyword') ?? '');
        return new Response('OK');
    }
}
