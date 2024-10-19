<?php

namespace App\Controller\FrontOffice;

use App\Entity\Track;
use App\Service\StreamService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Attribute\Route;

class AudioController extends AbstractController
{
    #[Route('/track/stream/{id}', name: 'track_stream')]
    public function index(StreamService $streamService,
                          Track         $track): StreamedResponse
    {
        $trackPath = 'uploads/discography/' . $track->getAlbum()->getSlug() . '/' . $track->getFilename();

        return $streamService->streamAudio($trackPath);
    }
}
