<?php

namespace App\Controller\BackOffice\Biography;

use App\Repository\BiographyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/administration/biographie', name: 'app_back_office_biography_')]
class DefaultController extends AbstractController
{
    #[Route('', name: 'home')]
    public function index(BiographyRepository $biographyRepository): Response
    {
        return $this->render('back_office/biography/default/index.html.twig', [
            'biographies' => $biographyRepository->findBy([], ['position' => 'ASC']),
        ]);
    }
}
