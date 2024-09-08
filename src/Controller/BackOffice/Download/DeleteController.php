<?php

namespace App\Controller\BackOffice\Download;

use App\Entity\Download;
use App\Service\FileUploaderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DeleteController extends AbstractController
{
    #[Route('/administration/documents/supprimer/{id}', name: 'app_back_office_download_delete')]
    public function index(EntityManagerInterface $entityManager,
                          FileUploaderService    $fileUploaderService,
                          Download               $document): Response
    {
        if($document->getFileName()) {
            $fileUploaderService->remove('document', $document->getFileName());
        }
        $entityManager->remove($document);
        $entityManager->flush();

        $this->addFlash('danger', "Le document {$document->getDocumentName()} a été supprimé");

        return $this->redirectToRoute('app_back_office_download_home');
    }
}
