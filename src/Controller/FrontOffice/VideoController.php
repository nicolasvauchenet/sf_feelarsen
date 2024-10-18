<?php

namespace App\Controller\FrontOffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VideoController extends AbstractController
{
    #[Route('/les-videos', name: 'app_front_office_video')]
    public function index(): Response
    {
        return $this->render('front_office/video/index.html.twig');
    }
}
