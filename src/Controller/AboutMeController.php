<?php
declare(strict_types=1);

namespace App\Controller;

use App\Module\AboutMe\App\HobbyService;
use App\View\AboutMe\AboutMePageView;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
