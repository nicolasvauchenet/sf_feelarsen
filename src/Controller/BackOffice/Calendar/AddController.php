<?php

namespace App\Controller\BackOffice\Calendar;

use App\Entity\Calendar;
use App\Form\CalendarType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AddController extends AbstractController
{
    #[Route('/administration/nouveau-calendrier', name: 'app_back_office_calendar_add')]
    public function index(Request                $request,
                          EntityManagerInterface $entityManager): Response
    {
        $calendar = new Calendar();
        $form = $this->createForm(CalendarType::class, $calendar);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($calendar);
            $entityManager->flush();

            $this->addFlash('success', "Le calendrier {$calendar->getName()} a été créé");

            return $this->redirectToRoute('app_back_office_calendar_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back_office/calendar/add/index.html.twig', [
            'form' => $form->createView(),
        ], new Response(null, $form->isSubmitted() && !$form->isValid() ? 422 : 201));
    }
}
