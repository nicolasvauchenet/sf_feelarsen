<?php

namespace App\Controller\BackOffice\Calendar;

use App\Entity\Calendar;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/administration/calendriers', name: 'app_back_office_calendar_')]
class ViewController extends AbstractController
{
    #[Route('/détails/{slug}', name: 'view')]
    public function index(Calendar $calendar): Response
    {
        return $this->render('back_office/calendar/view/index.html.twig', [
            'calendar' => $calendar,
        ]);
    }
}
