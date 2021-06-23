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
    private HobbyService $hs;

    public function __construct(HobbyService $hs)
    {
        $this->hs = $hs;
    }

    public function aboutMePage(): Response
    {
        $view = new AboutMePageView($this->hs->getHobbies());
        return $this->render('about_me/index.html.twig', $view->buildParams());
    }

    public function updateImages(Request $request): Response
    {
        $this->hs->updateHobbies($request->request->get('keyword') ?? '');
        return new Response('OK');
    }
}
