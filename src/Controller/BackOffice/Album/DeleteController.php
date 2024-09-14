<?php

namespace App\Controller\BackOffice\Album;

use App\Entity\Album;
use App\Service\FileUploaderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DeleteController extends AbstractController
{
    #[Route('/administration/album/supprimer/{id}', name: 'app_back_office_album_delete')]
    public function index(EntityManagerInterface $entityManager,
                          FileUploaderService    $fileUploaderService,
                          Album                  $album): Response
    {
        if($album->getCover()) {
            $fileUploaderService->remove('album/' . $album->getSlug(), $album->getCover());
            $fileUploaderService->removeDirectory('album/' . $album->getSlug());
        }

        $entityManager->remove($album);
        $entityManager->flush();

        $this->addFlash('danger', "L'album {$album->getName()} a été supprimé");

        return $this->redirectToRoute('app_back_office_album_home');
    }

    #[Route('/administration/album/cover/supprimer/{id}', name: 'app_back_office_album_cover_delete')]
    public function deletePoster(EntityManagerInterface $entityManager,
                                 FileUploaderService    $fileUploaderService,
                                 Album                  $album): Response
    {
        $fileUploaderService->remove('album/' . $album->getSlug(), $album->getCover());
        $album->setCover(null);
        $entityManager->persist($album);
        $entityManager->flush();

        $this->addFlash('danger', "La couverture de l'album {$album->getName()} a été supprimée");

        return $this->redirectToRoute('app_back_office_album_home');
    }
}
