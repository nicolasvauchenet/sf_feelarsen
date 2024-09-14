<?php

namespace App\Controller\BackOffice\Album;

use App\Entity\Album;
use App\Form\AlbumType;
use App\Service\FileUploaderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class EditController extends AbstractController
{
    #[Route('/administration/album/modifier/{id}', name: 'app_back_office_album_edit')]
    public function index(Request                $request,
                          EntityManagerInterface $entityManager,
                          FileUploaderService    $fileUploaderService,
                          SluggerInterface       $slugger,
                          Album                  $album): Response
    {
        $oldName = $album->getName();
        $oldSlug = $album->getSlug();
        $oldCover = $album->getCover();
        $form = $this->createForm(AlbumType::class, $album);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $coverFile */
            $coverFile = $form->get('cover')->getData();
            if($coverFile) {
                if($album->getCover()) {
                    $fileUploaderService->remove('album/' . $album->getSlug(), $album->getCover());
                }
                $coverFileName = $fileUploaderService->upload($coverFile, 'album/' . strtolower($slugger->slug($album->getName())), strtolower($slugger->slug($album->getName())));
                $album->setCover($coverFileName);
            }

            if($album->getName() !== $oldName) {
                $fileUploaderService->renameDirectory('album/' . $oldSlug, 'album/' . strtolower($slugger->slug($album->getName())));
                $newCoverFilename = $fileUploaderService->renameFile(strtolower('album/' . $slugger->slug($album->getName())), $oldCover, strtolower($slugger->slug($album->getName())));
                $album->setCover($newCoverFilename);
            }

            $entityManager->persist($album);
            $entityManager->flush();

            $this->addFlash('info', "L'album {$album->getName()} a été modifié");

            return $this->redirectToRoute('app_back_office_album_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back_office/album/edit/index.html.twig', [
            'form' => $form->createView(),
            'album' => $album,
        ], new Response(null, $form->isSubmitted() && !$form->isValid() ? 422 : 200));
    }
}
