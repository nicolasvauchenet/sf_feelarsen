<?php

namespace App\Controller\FrontOffice;

use App\Repository\ArtistRepository;
use App\Repository\BiographyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BiographyController extends AbstractController
{
    #[Route('/le-groupe', name: 'app_front_office_biography')]
    public function index(ArtistRepository    $artistRepository,
                          BiographyRepository $biographyRepository): Response
    {
        return $this->render('front_office/biography/index.html.twig', [
            'artists' => $artistRepository->findAll(),
            'biographies' => $biographyRepository->findBy(['active' => true], ['position' => 'ASC']),
        ]);
    }
}
