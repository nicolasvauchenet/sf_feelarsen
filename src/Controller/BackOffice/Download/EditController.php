<?php

namespace App\Controller\BackOffice\Download;

use App\Entity\Download;
use App\Form\DownloadType;
use App\Service\FileUploaderService;
use App\Service\SettingsService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class EditController extends AbstractController
{
    #[Route('/administration/documents/modifier/{id}', name: 'app_back_office_download_edit')]
    public function index(Request                $request,
                          EntityManagerInterface $entityManager,
                          FileUploaderService    $fileUploaderService,
                          SluggerInterface       $slugger,
                          SettingsService        $settingsService,
                          Download               $document): Response
    {
        $oldDocumentName = $document->getDocumentName();
        $oldFileName = $document->getFileName();
        $form = $this->createForm(DownloadType::class, $document);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $documentFile */
            $documentFile = $form->get('fileName')->getData();
            if($documentFile) {
                if($document->getFileName()) {
                    $fileUploaderService->remove('document', $document->getFileName());
                }

                $documentFileName = $fileUploaderService->upload($documentFile, 'document', strtolower($slugger->slug($settingsService->getSettings()->getSiteName())) . '-' . strtolower($slugger->slug($document->getDocumentName())));
                $document->setFileName($documentFileName);
            }

            if($document->getDocumentName() !== $oldDocumentName) {
                $newDocumentFilename = $fileUploaderService->renameFile('document', $oldFileName, strtolower($slugger->slug($settingsService->getSettings()->getSiteName())) . '-' . strtolower($slugger->slug($document->getDocumentName())));
                $document->setFileName($newDocumentFilename);
            }

            $entityManager->persist($document);
            $entityManager->flush();

            $this->addFlash('info', "Le document {$document->getDocumentName()} a été modifié");

            return $this->redirectToRoute('app_back_office_download_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back_office/download/edit/index.html.twig', [
            'form' => $form->createView(),
            'document' => $document,
        ], new Response(null, $form->isSubmitted() && !$form->isValid() ? 422 : 200));
    }
}
