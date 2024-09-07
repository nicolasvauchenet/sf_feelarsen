<?php

namespace App\Controller\BackOffice\Date;

use App\Entity\Date;
use App\Form\DateType;
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
    #[Route('/administration/concert/modifier/{id}', name: 'app_back_office_date_edit')]
    public function index(Request                $request,
                          EntityManagerInterface $entityManager,
                          FileUploaderService    $fileUploaderService,
                          Date                   $date): Response
    {
        $form = $this->createForm(DateType::class, $date);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $posterFile */
            $posterFile = $form->get('poster')->getData();
            if($posterFile) {
                if($date->getPoster()) {
                    $fileUploaderService->remove('calendar/' . $date->getCalendar()->getSlug(), $date->getPoster());
                }
                $posterFileName = $fileUploaderService->upload($posterFile, 'calendar/' . $date->getCalendar()->getSlug(), $date->getStartAt()->format('Ymd'));
                $date->setPoster($posterFileName);
            }
            $entityManager->persist($date);
            $entityManager->flush();

            $this->addFlash('info', "Le concert du {$date->getStartAt()->format('d/m/Y')} - {$date->getLocation()} à {$date->getCity()} a été modifié");

            return $this->redirectToRoute('app_back_office_calendar_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back_office/date/edit/index.html.twig', [
            'form' => $form->createView(),
            'date' => $date,
        ], new Response(null, $form->isSubmitted() && !$form->isValid() ? 422 : 201));
    }
}
