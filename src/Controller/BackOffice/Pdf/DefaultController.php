<?php

namespace App\Controller\BackOffice\Pdf;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/administration/pdf', name: 'app_back_office_pdf_')]
class DefaultController extends AbstractController
{
    #[Route('/{type}', name: 'generate')]
    public function index(string $type = 'all'): Response
    {
        // Le HTML que tu veux convertir en PDF
        $htmlContent = $this->renderView("back_office/pdf/default/$type.html.twig", [
            'data' => 'your_data',
        ]);

        // URL de l'API WeasyPrint
        $apiUrl = 'http://localhost:5050/generate-pdf';

        // Envoyer une requête POST avec Guzzle
        $client = new Client();
        $response = $client->post($apiUrl, [
            'form_params' => [
                'html' => $htmlContent,
            ],
        ]);

        // Récupérer le PDF depuis la réponse
        $pdfContent = $response->getBody()->getContents();

        // Retourner le PDF en tant que réponse Symfony
        return new Response($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="generated.pdf"',
        ]);
    }
}
