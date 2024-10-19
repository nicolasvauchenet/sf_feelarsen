<?php

namespace App\Controller\FrontOffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LegalController extends AbstractController
{
    #[Route('/mentions-legales', name: 'app_front_office_legal')]
    public function index(): Response
    {
        return $this->render('front_office/legal/index.html.twig');
    }
}
