<?php

namespace App\Controller\BackOffice\Calendar;

use App\Entity\Calendar;
use App\Service\FileUploaderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DeleteController extends AbstractController
{
    #[Route('/administration/calendrier/supprimer/{id}', name: 'app_back_office_calendar_delete')]
    public function index(EntityManagerInterface $entityManager,
                          FileUploaderService    $fileUploaderService,
                          Calendar               $calendar): Response
    {
        if($calendar->getPoster()) {
            $fileUploaderService->remove('calendar/' . $calendar->getSlug(), $calendar->getPoster());
            $fileUploaderService->removeDirectory('calendar/' . $calendar->getSlug());
        }

        $entityManager->remove($calendar);
        $entityManager->flush();

        $this->addFlash('danger', "Le calendrier {$calendar->getName()} a été supprimé");

        return $this->redirectToRoute('app_back_office_calendar_home');
    }

    #[Route('/administration/calendrier/poster/supprimer/{id}', name: 'app_back_office_calendar_poster_delete')]
    public function deletePoster(EntityManagerInterface $entityManager,
                                 FileUploaderService    $fileUploaderService,
                                 Calendar               $calendar): Response
    {
        $fileUploaderService->remove('calendar/' . $calendar->getSlug(), $calendar->getPoster());
        $calendar->setPoster(null);
        $entityManager->persist($calendar);
        $entityManager->flush();

        $this->addFlash('danger', "Le poster du calendrier {$calendar->getName()} a été supprimé");

        return $this->redirectToRoute('app_back_office_calendar_home');
    }
}
