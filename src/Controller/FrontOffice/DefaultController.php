<?php

namespace App\Controller\FrontOffice;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\AlbumRepository;
use App\Repository\ArtistRepository;
use App\Repository\BiographyRepository;
use App\Repository\CalendarRepository;
use App\Repository\ContactRepository;
use App\Repository\DownloadRepository;
use App\Repository\VideoRepository;
use App\Service\MailerService;
use App\Service\SettingsService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/', name: 'app_front_office_home')]
    public function index(Request                $request,
                          EntityManagerInterface $entityManager,
                          MailerService          $mailerService,
                          SettingsService        $settingsService,
                          CalendarRepository     $calendarRepository,
                          ArtistRepository       $artistRepository,
                          BiographyRepository    $biographyRepository,
                          AlbumRepository        $albumRepository,
                          VideoRepository        $videoRepository,
                          DownloadRepository     $downloadRepository): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $mailerService->sendEmail([
                'from' => [
                    'type' => $form->get('senderType')->getData(),
                    'name' => $form->get('senderName')->getData(),
                    'email' => $form->get('senderEmail')->getData(),
                    'phone' => $form->get('senderPhone')->getData(),
                ],
                'to' => [
                    'name' => $settingsService->getSettings()->getSiteName(),
                    'email' => $settingsService->getSettings()->getContactEmail(),
                ],
                'subject' => $form->get('subject')->getData(),
                'message' => $form->get('message')->getData(),
            ], 'front_office/default/_email');

            $contact->setSentAt(new \DateTimeImmutable());
            $entityManager->persist($contact);
            $entityManager->flush();

            $this->addFlash('success', 'Merci ! Votre message a été envoyé, nous vous répondrons très vite !');

            return $this->redirectToRoute('app_front_office_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('front_office/default/index.html.twig', [
            'calendar' => $calendarRepository->findOneBy(['active' => true]),
            'artists' => $artistRepository->findAll(),
            'biography' => $biographyRepository->findBy([], ['position' => 'ASC']),
            'albums' => $albumRepository->findBy([], ['releasedAt' => 'DESC']),
            'clips' => $videoRepository->findBy(['type' => 'clip'], ['releasedAt' => 'DESC', 'name' => 'ASC']),
            'lives' => $videoRepository->findBy(['type' => 'live'], ['releasedAt' => 'DESC', 'name' => 'ASC']),
            'documents' => $downloadRepository->findBy(['active' => true]),
            'form' => $form->createView(),
        ], new Response(null, $form->isSubmitted() && !$form->isValid() ? 422 : 201));
    }
}
