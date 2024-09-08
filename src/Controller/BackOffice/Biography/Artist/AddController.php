<?php

namespace App\Controller\BackOffice\Biography\Artist;

use App\Entity\Artist;
use App\Form\ArtistType;
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
    #[Route('/administration/nouvel-artiste', name: 'app_back_office_biography_artist_add')]
    public function index(Request                $request,
                          EntityManagerInterface $entityManager,
                          FileUploaderService    $fileUploaderService,
                          SluggerInterface       $slugger): Response
    {
        $artist = new Artist();
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $photoFile */
            $photoFile = $form->get('photo')->getData();
            if($photoFile) {
                $photoFileName = $fileUploaderService->upload($photoFile, 'artist', strtolower($slugger->slug($artist->getName())));
                $artist->setPhoto($photoFileName);
            }
            $entityManager->persist($artist);
            $entityManager->flush();

            $this->addFlash('success', "L'artiste {$artist->getName()} a été créé");

            return $this->redirectToRoute('app_back_office_biography_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back_office/biography/artist/add/index.html.twig', [
            'form' => $form->createView(),
        ], new Response(null, $form->isSubmitted() && !$form->isValid() ? 422 : 201));
    }
}
