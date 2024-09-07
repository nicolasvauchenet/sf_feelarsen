<?php

namespace App\Controller\BackOffice\Calendar;

use App\Entity\Calendar;
use App\Form\CalendarType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EditController extends AbstractController
{
    #[Route('/administration/calendrier/modifier/{id}', name: 'app_back_office_calendar_edit')]
    public function index(Request                $request,
                          EntityManagerInterface $entityManager,
                          Calendar               $calendar): Response
    {
        $form = $this->createForm(CalendarType::class, $calendar);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($calendar);
            $entityManager->flush();

            $this->addFlash('info', "Le calendrier {$calendar->getName()} a été modifié");

            return $this->redirectToRoute('app_back_office_calendar_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back_office/calendar/edit/index.html.twig', [
            'form' => $form->createView(),
            'calendar' => $calendar,
        ], new Response(null, $form->isSubmitted() && !$form->isValid() ? 422 : 201));
    }
}
