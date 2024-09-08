<?php

namespace App\Controller\BackOffice\Biography\Artist;

use App\Entity\Artist;
use App\Service\FileUploaderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DeleteController extends AbstractController
{
    #[Route('/administration/biographie/artiste/supprimer/{id}', name: 'app_back_office_biography_artist_delete')]
    public function index(EntityManagerInterface $entityManager,
                          FileUploaderService    $fileUploaderService,
                          Artist                 $artist): Response
    {
        if($artist->getPhoto()) {
            $fileUploaderService->remove('artist', $artist->getPhoto());
        }

        $entityManager->remove($artist);
        $entityManager->flush();

        $this->addFlash('danger', "L'artiste {$artist->getName()} a été supprimé");

        return $this->redirectToRoute('app_back_office_biography_home');
    }

    #[Route('/administration/biographie/artiste/photo/supprimer/{id}', name: 'app_back_office_biography_artist_photo_delete')]
    public function deletePhoto(EntityManagerInterface $entityManager,
                                FileUploaderService    $fileUploaderService,
                                Artist                 $artist): Response
    {
        $fileUploaderService->remove('artist', $artist->getPhoto());
        $artist->setPhoto(null);
        $entityManager->persist($artist);
        $entityManager->flush();

        $this->addFlash('danger', "La photo de l'artiste {$artist->getName()} a été supprimée");

        return $this->redirectToRoute('app_back_office_biography_home');
    }
}
