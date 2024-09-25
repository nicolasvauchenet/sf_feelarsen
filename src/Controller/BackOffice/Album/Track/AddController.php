<?php

namespace App\Controller\BackOffice\Album\Track;

use App\Entity\Album;
use App\Entity\Track;
use App\Form\TrackType;
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
    #[Route('/administration/nouveau-morceau/{id}', name: 'app_back_office_track_add')]
    public function index(Request                $request,
                          EntityManagerInterface $entityManager,
                          FileUploaderService    $fileUploaderService,
                          SluggerInterface       $slugger,
                          Album                  $album): Response
    {
        $track = (new Track())
            ->setAlbum($album);
        $form = $this->createForm(TrackType::class, $track);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $audioFile */
            $audioFile = $form->get('fileName')->getData();
            if($audioFile) {
                $audioFileName = $fileUploaderService->upload($audioFile, 'album/' . $album->getSlug(), strtolower($slugger->slug($track->getTitle())));
                $track->setFileName($audioFileName);
            }
            $entityManager->persist($track);
            $entityManager->flush();

            $this->addFlash('success', "Le morceau {$track->getTitle()} a été créé dans l'album {$album->getName()}");

            return $this->redirectToRoute('app_back_office_album_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back_office/track/add/index.html.twig', [
            'form' => $form->createView(),
        ], new Response(null, $form->isSubmitted() && !$form->isValid() ? 422 : 201));
    }
}
