<?php

namespace App\Controller\FrontOffice;

use App\Repository\AlbumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DiscographyController extends AbstractController
{
    #[Route('/les-albums', name: 'app_front_office_discography')]
    public function index(AlbumRepository $albumRepository): Response
    {
        return $this->render('front_office/discography/index.html.twig', [
            'eps' => $albumRepository->findBy(['type' => 'EP', 'active' => true], ['releasedAt' => 'DESC']),
            'lives' => $albumRepository->findBy(['type' => 'Live', 'active' => true], ['releasedAt' => 'DESC']),
        ]);
    }
}
