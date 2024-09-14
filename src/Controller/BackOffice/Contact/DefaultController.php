<?php

namespace App\Controller\BackOffice\Contact;

use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/administration/contacts', name: 'app_back_office_contact_home')]
    public function index(ContactRepository $contactRepository): Response
    {
        return $this->render('back_office/contact/default/index.html.twig', [
            'messages' => $contactRepository->findBy([], ['sentAt' => 'DESC']),
        ]);
    }
}
