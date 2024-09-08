<?php

namespace App\Controller\BackOffice\Settings;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EditController extends AbstractController
{
    #[Route('/administration/parametres', name: 'app_back_office_settings_edit')]
    public function index(): Response
    {
        return $this->render('back_office/settings/edit/index.html.twig', [

        ]);
    }
}
