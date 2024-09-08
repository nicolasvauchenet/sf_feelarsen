<?php

namespace App\Controller\BackOffice\Settings;

use App\Form\SettingsType;
use App\Repository\SettingsRepository;
use App\Service\FileUploaderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EditController extends AbstractController
{
    #[Route('/administration/parametres', name: 'app_back_office_settings_edit')]
    public function index(Request                $request,
                          EntityManagerInterface $entityManager,
                          FileUploaderService    $fileUploaderService,
                          SettingsRepository     $settingsRepository): Response
    {
        $settings = $settingsRepository->find(1);
        if(!$settings) {
            return $this->redirectToRoute('app_back_office_home');
        }

        $form = $this->createForm(SettingsType::class, $settings);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $siteLogoFile */
            $siteLogoFile = $form->get('siteLogo')->getData();
            if($siteLogoFile) {
                if($settings->getSiteLogo()) {
                    $fileUploaderService->remove('settings', $settings->getSiteLogo());
                }
                $siteLogoFileName = $fileUploaderService->upload($siteLogoFile, 'settings', 'sitelogo');
                $settings->setSiteLogo($siteLogoFileName);
            }

            /** @var UploadedFile $siteCoverFile */
            $siteCoverFile = $form->get('siteCover')->getData();
            if($siteCoverFile) {
                if($settings->getSiteCover()) {
                    $fileUploaderService->remove('settings', $settings->getSiteCover());
                }
                $siteCoverFileName = $fileUploaderService->upload($siteCoverFile, 'settings', 'sitecover');
                $settings->setSiteCover($siteCoverFileName);
            }

            /** @var UploadedFile $contactCoverFile */
            $contactCoverFile = $form->get('contactCover')->getData();
            if($contactCoverFile) {
                if($settings->getContactCover()) {
                    $fileUploaderService->remove('settings', $settings->getContactCover());
                }
                $contactCoverFileName = $fileUploaderService->upload($contactCoverFile, 'settings', 'contactcover');
                $settings->setContactCover($contactCoverFileName);
            }

            $entityManager->persist($settings);
            $entityManager->flush();

            $this->addFlash('info', 'Les paramètres du site ont été modifiés');

            return $this->redirectToRoute('app_back_office_settings_edit', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back_office/settings/edit/index.html.twig', [
            'form' => $form->createView(),
            'settings' => $settings,
        ], new Response(null, $form->isSubmitted() && !$form->isValid() ? 422 : 200));
    }
}
