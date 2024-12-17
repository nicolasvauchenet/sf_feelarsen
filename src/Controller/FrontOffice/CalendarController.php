<?php

namespace App\Controller\FrontOffice;

use App\Repository\CalendarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CalendarController extends AbstractController
{
    #[Route('/les-anciennes-dates', name: 'app_front_office_calendar')]
    public function index(CalendarRepository $calendarRepository): Response
    {
        return $this->render('front_office/calendar/index.html.twig', [
            'calendars' => $calendarRepository->findBy(['active' => false], ['endAt' => 'DESC']),
        ]);
    }
}
