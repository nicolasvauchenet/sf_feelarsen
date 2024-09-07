<?php

namespace App\Controller\BackOffice\Calendar;

use App\Entity\Calendar;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DeleteController extends AbstractController
{
    #[Route('/administration/calendrier/supprimer/{id}', name: 'app_back_office_calendar_delete')]
    public function index(EntityManagerInterface $entityManager,
                          Calendar               $calendar): Response
    {
        $entityManager->remove($calendar);
        $entityManager->flush();

        $this->addFlash('danger', "Le calendrier {$calendar->getName()} a été supprimé");

        return $this->redirectToRoute('app_back_office_calendar_home');
    }
}
