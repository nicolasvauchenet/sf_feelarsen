<?php

namespace App\Controller\FrontOffice;

use App\Entity\Video;
use App\Service\StreamService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\Routing\Attribute\Route;

class VideoController extends AbstractController
{
    #[Route('/video/stream/{id}', name: 'video_stream')]
    public function index(StreamService $streamService,
                          Video         $video): BinaryFileResponse
    {
        $trackPath = 'uploads/video/' . $video->getType() . '/' . $video->getFileName();

        return $streamService->streamVideo($trackPath);
    }
}
