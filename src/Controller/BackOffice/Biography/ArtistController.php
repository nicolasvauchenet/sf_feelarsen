<?php

namespace App\Controller\BackOffice\Biography;

use App\Entity\Artist;
use App\Form\ArtistType;
use App\Repository\ArtistRepository;
use App\Service\FileUploaderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/administration/biographie/artiste', name: 'app_back_office_biography_artist_')]
class ArtistController extends AbstractController
{
    #[Route('/nouveau', name: 'add')]
    public function add(
        Request $request,
        EntityManagerInterface $entityManager,
        FileUploaderService $fileUploaderService,
        SluggerInterface $slugger,
        ArtistRepository $artistRepository
    ): Response {
        $artist = new Artist();
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $photoFile */
            $photoFile = $form->get('photo')->getData();
            if ($photoFile) {
                $photoFileName = $fileUploaderService->upload(
                    $photoFile,
                    'artist',
                    strtolower($slugger->slug($artist->getName()))
                );
                $artist->setPhoto($photoFileName);
            }

            $entityManager->persist($artist);
            $entityManager->flush();

            $this->addFlash('success', "L'artiste a été ajouté avec succès.");

            return $this->redirectToRoute('app_back_office_biography_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back_office/biography/artist/add.html.twig', [
            'form' => $form->createView(),
        ], new Response(null, $form->isSubmitted() && !$form->isValid() ? 422 : 200));
    }

    #[Route('/modifier/{slug}', name: 'edit')]
    public function edit(
        Request $request,
        EntityManagerInterface $entityManager,
        FileUploaderService $fileUploaderService,
        SluggerInterface $slugger,
        Artist $artist
    ): Response {
        $artistSlug = $artist->getSlug();
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $photoFile */
            $photoFile = $form->get('photo')->getData();
            if ($photoFile) {
                if ($artist->getPhoto()) {
                    $fileUploaderService->remove('artist', $artist->getPhoto());
                }
                $photoFileName = $fileUploaderService->upload(
                    $photoFile,
                    'artist',
                    strtolower($slugger->slug($artist->getName()))
                );
                $artist->setPhoto($photoFileName);
            }

            $entityManager->persist($artist);
            $entityManager->flush();

            $this->addFlash('info', "L'artiste a été modifié avec succès.");

            return $this->redirectToRoute('app_back_office_biography_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back_office/biography/artist/edit.html.twig', [
            'form' => $form->createView(),
            'artist' => $artist,
        ], new Response(null, $form->isSubmitted() && !$form->isValid() ? 422 : 200));
    }

    #[Route('/supprimer/{slug}', name: 'delete')]
    public function delete(
        FileUploaderService $fileUploaderService,
        EntityManagerInterface $entityManager,
        Artist $artist
    ) {
        if ($artist->getPhoto()) {
            $fileUploaderService->remove('artist', $artist->getPhoto());
        }

        $entityManager->remove($artist);
        $entityManager->flush();

        $this->addFlash('warning', "L'artiste a été supprimé avec succès.");

        return $this->redirectToRoute('app_back_office_biography_home', [], Response::HTTP_SEE_OTHER);
    }
}
