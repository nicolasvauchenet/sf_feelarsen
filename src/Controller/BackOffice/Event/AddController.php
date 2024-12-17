<?php

namespace App\Controller\BackOffice\Event;

use App\Entity\Calendar;
use App\Entity\Event;
use App\Form\EventType;
use App\Service\FileUploaderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/administration/dates', name: 'app_back_office_event_')]
class AddController extends AbstractController
{
    #[Route('/nouvelle/{slug}', name: 'add')]
    public function index(Request                $request,
                          EntityManagerInterface $entityManager,
                          FileUploaderService    $fileUploaderService,
                          SluggerInterface       $slugger,
                          Calendar               $calendar): Response
    {
        $event = new Event();
        $event->setCalendar($calendar);
        $event->setActive(true);
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $posterFile */
            $posterFile = $form->get('poster')->getData();
            if($posterFile) {
                $posterFileName = $fileUploaderService->upload($posterFile, 'calendar/' . $calendar->getSlug(), strtolower($slugger->slug($event->getName())));
                $event->setPoster($posterFileName);
            }
            $entityManager->persist($event);
            $entityManager->flush();

            $this->addFlash('success', 'La date a été ajoutée avec succès.');

            return $this->redirectToRoute('app_back_office_calendar_view', ['slug' => $calendar->getSlug()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back_office/event/add/index.html.twig', [
            'form' => $form->createView(),
            'calendar' => $calendar,
        ], new Response(null, $form->isSubmitted() && !$form->isValid() ? 422 : 200));
    }
}
