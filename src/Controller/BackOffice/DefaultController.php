<?php

namespace App\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/administration', name: 'app_back_office_home')]
    public function index(): Response
    {
        return $this->render('back_office/default/index.html.twig');
    }
}
