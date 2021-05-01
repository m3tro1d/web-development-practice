<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Module\AboutMe\App\HobbieService;
use App\View\AboutMe\AboutMePageView;

class AboutMeController extends AbstractController
{
    public function aboutMePage(HobbieService $hs): Response
    {
        $view = new AboutMePageView($hs->getHobbies());
        return $this->render('homepage/index.html.twig', $view->buildParams());
    }
}
