<?php

namespace App\Controller\BackOffice\Contact;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DeleteController extends AbstractController
{
    #[Route('/administration/contacts/supprimer/{id}', name: 'app_back_office_contact_delete')]
    public function index(EntityManagerInterface $entityManager,
                          Contact                $contact): Response
    {
        $entityManager->remove($contact);
        $entityManager->flush();

        $this->addFlash('danger', "Le message de {$contact->getSenderName()} du {$contact->getSentAt()->format('d/m/Y à H:i')} a été supprimé");

        return $this->redirectToRoute('app_back_office_contact_home');
    }
}
