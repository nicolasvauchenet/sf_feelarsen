<?php

namespace App\Controller\FrontOffice;

use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VideoController extends AbstractController
{
    #[Route('/les-videos', name: 'app_front_office_video')]
    public function index(VideoRepository $videoRepository): Response
    {
        return $this->render('front_office/video/index.html.twig', [
            'clips' => $videoRepository->findBy(['type' => 'Clip', 'active' => true], ['releasedAt' => 'DESC']),
            'lives' => $videoRepository->findBy(['type' => 'Live', 'active' => true], ['releasedAt' => 'DESC']),
        ]);
    }
}
