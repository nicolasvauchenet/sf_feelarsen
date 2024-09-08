<?php

namespace App\Controller\BackOffice\Download;

use App\Repository\DownloadRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/administration/documents', name: 'app_back_office_download_home')]
    public function index(DownloadRepository $downloadRepository): Response
    {
        return $this->render('back_office/download/default/index.html.twig', [
            'documents' => $downloadRepository->findAll(),
        ]);
    }
}
