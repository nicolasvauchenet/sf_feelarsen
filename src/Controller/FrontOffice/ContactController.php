<?php

namespace App\Controller\FrontOffice;

use App\Entity\Message;
use App\Form\MessageType;
use App\Repository\ContactRepository;
use App\Service\MailerService;
use App\Service\SettingsService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/contactez-nous', name: 'app_front_office_contact')]
    public function index(ContactRepository      $contactRepository,
                          Request                $request,
                          EntityManagerInterface $entityManager,
                          MailerService          $mailerService,
                          SettingsService        $settingsService): Response
    {
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
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
                    'email' => 'contact@bastardsoundsystem.org',
                ],
                'subject' => $form->get('subject')->getData(),
                'message' => $form->get('message')->getData(),
            ], 'front_office/contact/_email');

            $message->setStatus('new');
            $entityManager->persist($message);
            $entityManager->flush();

            $this->addFlash('success', 'Votre message a bien été envoyé, merci ! Nous vous répondrons très vite !');

            return $this->redirectToRoute('app_front_office_contact');
        }

        return $this->render('front_office/contact/index.html.twig', [
            'contacts' => $contactRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }
}
