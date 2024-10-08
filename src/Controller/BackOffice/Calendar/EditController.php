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

class EditController extends AbstractController
{
    #[Route('/administration/calendrier/modifier/{id}', name: 'app_back_office_calendar_edit')]
    public function index(Request                $request,
                          EntityManagerInterface $entityManager,
                          FileUploaderService    $fileUploaderService,
                          SluggerInterface       $slugger,
                          Calendar               $calendar): Response
    {
        $oldName = $calendar->getName();
        $oldSlug = $calendar->getSlug();
        $oldPoster = $calendar->getPoster();

        $form = $this->createForm(CalendarType::class, $calendar);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $posterFile */
            $posterFile = $form->get('poster')->getData();
            if($posterFile) {
                if($calendar->getPoster()) {
                    $fileUploaderService->remove('calendar/' . $calendar->getSlug(), $calendar->getPoster());
                }
                $posterFileName = $fileUploaderService->upload($posterFile, 'calendar/' . strtolower($slugger->slug($calendar->getName())), strtolower($slugger->slug($calendar->getName())));
                $calendar->setPoster($posterFileName);
            }

            if($calendar->getName() !== $oldName) {
                $fileUploaderService->renameDirectory('calendar/' . $oldSlug, 'calendar/' . strtolower($slugger->slug($calendar->getName())));
                $newPosterFilename = $fileUploaderService->renameFile(strtolower('calendar/' . $slugger->slug($calendar->getName())), $oldPoster, strtolower($slugger->slug($calendar->getName())));
                $calendar->setPoster($newPosterFilename);
            }

            $entityManager->persist($calendar);
            $entityManager->flush();

            $this->addFlash('info', "Le calendrier {$calendar->getName()} a été modifié");

            return $this->redirectToRoute('app_back_office_calendar_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back_office/calendar/edit/index.html.twig', [
            'form' => $form->createView(),
            'calendar' => $calendar,
        ], new Response(null, $form->isSubmitted() && !$form->isValid() ? 422 : 200));
    }
}
