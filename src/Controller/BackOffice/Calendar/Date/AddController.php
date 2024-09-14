<?php

namespace App\Controller\BackOffice\Calendar\Date;

use App\Entity\Calendar;
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

class AddController extends AbstractController
{
    #[Route('/administration/nouveau-concert/{id}', name: 'app_back_office_date_add')]
    public function index(Request                $request,
                          EntityManagerInterface $entityManager,
                          FileUploaderService    $fileUploaderService,
                          SluggerInterface       $slugger,
                          Calendar               $calendar): Response
    {
        $date = (new Date())
            ->setCalendar($calendar);
        $form = $this->createForm(DateType::class, $date);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $posterFile */
            $posterFile = $form->get('poster')->getData();
            if($posterFile) {
                $posterFileName = $fileUploaderService->upload($posterFile, 'calendar/' . strtolower($slugger->slug($calendar->getName())), $date->getStartAt()->format('Ymd'));
                $date->setPoster($posterFileName);
            }
            $entityManager->persist($date);
            $entityManager->flush();

            $this->addFlash('success', "Le concert du {$date->getStartAt()->format('d/m/Y')} - {$date->getLocation()} à {$date->getCity()} a été créé");

            return $this->redirectToRoute('app_back_office_calendar_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back_office/date/add/index.html.twig', [
            'form' => $form->createView(),
        ], new Response(null, $form->isSubmitted() && !$form->isValid() ? 422 : 201));
    }
}
