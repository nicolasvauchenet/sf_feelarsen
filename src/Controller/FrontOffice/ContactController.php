<?php

namespace App\Controller\FrontOffice;

use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    #[Route('/contactez-nous', name: 'app_front_office_contact')]
    public function index(ContactRepository $contactRepository): Response
    {
        return $this->render('front_office/contact/index.html.twig', [
            'contacts' => $contactRepository->findAll(),
        ]);
    }
}
