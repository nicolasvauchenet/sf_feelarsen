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

class EditController extends AbstractController
{
    #[Route('/administration/biographie/artiste/modifier/{id}', name: 'app_back_office_biography_artist_edit')]
    public function index(Request                $request,
                          EntityManagerInterface $entityManager,
                          FileUploaderService    $fileUploaderService,
                          SluggerInterface       $slugger,
                          Artist                 $artist): Response
    {
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $photoFile */
            $photoFile = $form->get('photo')->getData();
            if($photoFile) {
                if($artist->getPhoto()) {
                    $fileUploaderService->remove('artist', $artist->getPhoto());
                }
                $photoFileName = $fileUploaderService->upload($photoFile, 'artist', strtolower($slugger->slug($artist->getName())));
                $artist->setPhoto($photoFileName);
            }
            $entityManager->persist($artist);
            $entityManager->flush();

            $this->addFlash('info', "L'artiste {$artist->getName()} a été modifié");

            return $this->redirectToRoute('app_back_office_biography_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back_office/biography/artist/edit/index.html.twig', [
            'form' => $form->createView(),
            'artist' => $artist,
        ], new Response(null, $form->isSubmitted() && !$form->isValid() ? 422 : 201));
    }
}
