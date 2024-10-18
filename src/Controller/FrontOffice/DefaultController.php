<?php

namespace App\Controller\FrontOffice;

use App\Repository\CalendarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_front_office_home')]
    public function index(CalendarRepository $calendarRepository): Response
    {
        return $this->render('front_office/default/index.html.twig', [
            'calendar' => $calendarRepository->findOneBy(['active' => true]),
        ]);
    }
}
