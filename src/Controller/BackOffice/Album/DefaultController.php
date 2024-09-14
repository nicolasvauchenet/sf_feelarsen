<?php

namespace App\Controller\BackOffice\Album;

use App\Repository\AlbumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/administration/album', name: 'app_back_office_album_home')]
    public function index(AlbumRepository $albumRepository): Response
    {
        return $this->render('back_office/album/default/index.html.twig', [
            'albums' => $albumRepository->findBy([], ['releasedAt' => 'DESC']),
        ]);
    }
}
