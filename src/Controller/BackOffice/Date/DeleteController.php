<?php

namespace App\Controller\BackOffice\Date;

use App\Entity\Date;
use App\Service\FileUploaderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DeleteController extends AbstractController
{
    #[Route('/administration/concert/supprimer/{id}', name: 'app_back_office_date_delete')]
    public function index(EntityManagerInterface $entityManager,
                          FileUploaderService    $fileUploaderService,
                          Date                   $date): Response
    {
        $calendar = $date->getCalendar();
        if($date->getPoster()) {
            $fileUploaderService->remove('calendar/' . $calendar->getSlug(), $date->getPoster());
        }
        $calendar->removeDate($date);
        $entityManager->persist($calendar);
        $entityManager->flush();

        $this->addFlash('danger', "Le concert du {$date->getStartAt()->format('d/m/Y')} - {$date->getLocation()} à {$date->getCity()} a été supprimé");

        return $this->redirectToRoute('app_back_office_calendar_home');
    }

    #[Route('/administration/concert/poster/supprimer/{id}', name: 'app_back_office_date_poster_delete')]
    public function deletePoster(EntityManagerInterface $entityManager,
                                 FileUploaderService    $fileUploaderService,
                                 Date                   $date): Response
    {
        $fileUploaderService->remove('calendar/' . $date->getCalendar()->getSlug(), $date->getPoster());
        $date->setPoster(null);
        $entityManager->persist($date);
        $entityManager->flush();

        $this->addFlash('danger', "L'affiche du concert du {$date->getStartAt()->format('d/m/Y')} - {$date->getLocation()} à {$date->getCity()} a été supprimée");

        return $this->redirectToRoute('app_back_office_calendar_home');
    }
}
