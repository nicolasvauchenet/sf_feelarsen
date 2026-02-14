<?php

namespace App\Controller\BackOffice\Biography;

use App\Repository\ArtistRepository;
use App\Repository\BiographyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/administration/biographie', name: 'app_back_office_biography_')]
class DefaultController extends AbstractController
{
    #[Route('', name: 'home')]
    public function index(
        ArtistRepository $artistRepository,
        BiographyRepository $biographyRepository
    ): Response {
        return $this->render('back_office/biography/default/index.html.twig', [
            'artists' => $artistRepository->findAll(),
            'biographies' => $biographyRepository->findBy([], ['position' => 'ASC']),
        ]);
    }
}
