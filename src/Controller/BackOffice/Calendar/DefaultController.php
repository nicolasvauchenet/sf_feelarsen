<?php

namespace App\Controller\BackOffice\Calendar;

use App\Repository\CalendarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/administration/calendriers', name: 'app_back_office_calendar_')]
class DefaultController extends AbstractController
{
    #[Route('', name: 'home')]
    public function index(CalendarRepository $calendarRepository): Response
    {
        return $this->render('back_office/calendar/default/index.html.twig', [
            'calendars' => $calendarRepository->findBy([], ['endAt' => 'DESC']),
        ]);
    }
}
