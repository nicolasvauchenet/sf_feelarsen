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

class AddController extends AbstractController
{
    #[Route('/administration/nouvel-album', name: 'app_back_office_album_add')]
    public function index(Request                $request,
                          EntityManagerInterface $entityManager,
                          FileUploaderService    $fileUploaderService,
                          SluggerInterface       $slugger): Response
    {
        $album = new Album();
        $form = $this->createForm(AlbumType::class, $album);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $coverFile */
            $coverFile = $form->get('cover')->getData();
            if($coverFile) {
                $coverFileName = $fileUploaderService->upload($coverFile, 'album/' . strtolower($slugger->slug($album->getName())), strtolower($slugger->slug($album->getName())));
                $album->setCover($coverFileName);
            }
            $entityManager->persist($album);
            $entityManager->flush();

            $this->addFlash('success', "L'album {$album->getName()} a été créé");

            return $this->redirectToRoute('app_back_office_album_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back_office/album/add/index.html.twig', [
            'form' => $form->createView(),
        ], new Response(null, $form->isSubmitted() && !$form->isValid() ? 422 : 201));
    }
}
