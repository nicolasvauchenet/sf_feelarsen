<?php

namespace App\Controller\BackOffice\Event;

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
class EditController extends AbstractController
{
    #[Route('/modifier/{slug}', name: 'edit')]
    public function index(Request                $request,
                          EntityManagerInterface $entityManager,
                          FileUploaderService    $fileUploaderService,
                          SluggerInterface       $slugger,
                          Event                  $event): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $posterFile */
            $posterFile = $form->get('poster')->getData();
            if($posterFile) {
                if($event->getPoster()) {
                    $fileUploaderService->remove('calendar/' . $event->getCalendar()->getSlug(), $event->getPoster());
                }
                $posterFileName = $fileUploaderService->upload($posterFile, 'calendar/' . $event->getCalendar()->getSlug(), strtolower($slugger->slug($event->getName())));
                $event->setPoster($posterFileName);
            }
            $entityManager->persist($event);
            $entityManager->flush();

            $this->addFlash('success', 'La date a été modifiée avec succès.');

            return $this->redirectToRoute('app_back_office_calendar_view', ['slug' => $event->getCalendar()->getSlug()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back_office/event/edit/index.html.twig', [
            'form' => $form->createView(),
            'event' => $event,
        ], new Response(null, $form->isSubmitted() && !$form->isValid() ? 422 : 200));
    }
}
