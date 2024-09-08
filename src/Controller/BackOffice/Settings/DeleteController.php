<?php

namespace App\Controller\BackOffice\Settings;

use App\Entity\Settings;
use App\Service\FileUploaderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DeleteController extends AbstractController
{
    #[Route('/administration/parametres/supprimer-image/{id}/{type}', name: 'app_back_office_settings_image_delete')]
    public function index(EntityManagerInterface $entityManager,
                          FileUploaderService    $fileUploaderService,
                          Settings               $settings,
                          string                 $type): Response
    {
        switch($type) {
            case 'sitelogo':
                if($settings->getSiteLogo()) {
                    $fileUploaderService->remove('settings', $settings->getSiteLogo());
                    $settings->setSiteLogo(null);
                    $this->addFlash('danger', 'Le logo du site a été supprimé');
                }
                break;
            case 'sitecover':
                if($settings->getSiteCover()) {
                    $fileUploaderService->remove('settings', $settings->getSiteCover());
                    $settings->setSiteCover(null);
                    $this->addFlash('danger', 'La photo de couverture du site a été supprimée');
                }
                break;
            case 'contactcover':
                if($settings->getContactCover()) {
                    $fileUploaderService->remove('settings', $settings->getContactCover());
                    $settings->setContactCover(null);
                    $this->addFlash('danger', 'La photo de la section Contact a été supprimée');
                }
                break;
            default:
                break;
        }
        $entityManager->persist($settings);
        $entityManager->flush();

        return $this->redirectToRoute('app_back_office_settings_edit');
    }
}
