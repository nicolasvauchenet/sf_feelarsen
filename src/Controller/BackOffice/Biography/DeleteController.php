<?php

namespace App\Controller\BackOffice\Biography;

use App\Entity\Biography;
use App\Repository\BiographyRepository;
use App\Service\FileUploaderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DeleteController extends AbstractController
{
    #[Route('/administration/biographie/supprimer/{id}', name: 'app_back_office_biography_delete')]
    public function index(FileUploaderService    $fileUploaderService,
                          BiographyRepository    $biographyRepository,
                          Biography              $biography): Response
    {
        if($biography->getPhoto()) {
            $fileUploaderService->remove('biography', $biography->getPhoto());
        }
        $biographyRepository->deleteBiography($biography);

        $this->addFlash('danger', "L'article de biographie n°{$biography->getPosition()} a été supprimé");

        return $this->redirectToRoute('app_back_office_biography_home');
    }

    #[Route('/administration/biographie/photo/supprimer/{id}', name: 'app_back_office_biography_photo_delete')]
    public function deletePhoto(EntityManagerInterface $entityManager,
                                FileUploaderService    $fileUploaderService,
                                Biography              $biography): Response
    {
        $fileUploaderService->remove('biography', $biography->getPhoto());
        $biography->setPhoto(null);
        $entityManager->persist($biography);
        $entityManager->flush();

        $this->addFlash('danger', "La photo de l'article de biographie n°{$biography->getPosition()} a été supprimée");

        return $this->redirectToRoute('app_back_office_biography_home');
    }
}
