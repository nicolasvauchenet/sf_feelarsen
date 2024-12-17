<?php

namespace App\Controller\BackOffice\Calendar;

use App\Entity\Calendar;
use App\Form\CalendarType;
use App\Service\FileUploaderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/administration/calendriers', name: 'app_back_office_calendar_')]
class AddController extends AbstractController
{
    #[Route('/nouveau', name: 'add')]
    public function index(Request                $request,
                          EntityManagerInterface $entityManager,
                          FileUploaderService    $fileUploaderService,
                          SluggerInterface       $slugger): Response
    {
        $calendar = new Calendar();
        $calendar->setActive(true);
        $form = $this->createForm(CalendarType::class, $calendar);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $posterFile */
            $posterFile = $form->get('poster')->getData();
            if($posterFile) {
                $posterFileName = $fileUploaderService->upload($posterFile, 'calendar/' . strtolower($slugger->slug($calendar->getName())), strtolower($slugger->slug($calendar->getName())));
                $calendar->setPoster($posterFileName);
            }

            $entityManager->persist($calendar);
            $entityManager->flush();

            $this->addFlash('success', 'Le calendrier a été ajouté avec succès.');

            return $this->redirectToRoute('app_back_office_calendar_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back_office/calendar/add/index.html.twig', [
            'form' => $form->createView(),
        ], new Response(null, $form->isSubmitted() && !$form->isValid() ? 422 : 200));
    }
}
