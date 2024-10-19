<?php

namespace App\Controller\FrontOffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PrivacyController extends AbstractController
{
    #[Route('/politique-de-confidentialite', name: 'app_front_office_privacy')]
    public function index(): Response
    {
        return $this->render('front_office/privacy/index.html.twig');
    }
}
