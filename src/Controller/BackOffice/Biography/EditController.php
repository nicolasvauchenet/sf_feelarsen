<?php

namespace App\Controller\BackOffice\Biography;

use App\Entity\Biography;
use App\Form\BiographyType;
use App\Repository\BiographyRepository;
use App\Service\FileUploaderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EditController extends AbstractController
{
    #[Route('/administration/biographie/modifier/{id}', name: 'app_back_office_biography_edit')]
    public function index(Request                $request,
                          EntityManagerInterface $entityManager,
                          FileUploaderService    $fileUploaderService,
                          BiographyRepository    $biographyRepository,
                          Biography              $biography): Response
    {
        $form = $this->createForm(BiographyType::class, $biography);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $biographyRepository->resetPositions($biography);

            /** @var UploadedFile $photoFile */
            $photoFile = $form->get('photo')->getData();
            if($photoFile) {
                if($biography->getPhoto()) {
                    $fileUploaderService->remove('biography', $biography->getPhoto());
                }
                $photoFileName = $fileUploaderService->upload($photoFile, 'biography', 'biography-' . $biography->getPosition());
                $biography->setPhoto($photoFileName);
            }
            $entityManager->persist($biography);
            $entityManager->flush();

            $this->addFlash('info', "L'article de biographie a été modifié");

            return $this->redirectToRoute('app_back_office_biography_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back_office/biography/edit/index.html.twig', [
            'form' => $form->createView(),
            'biography' => $biography,
        ], new Response(null, $form->isSubmitted() && !$form->isValid() ? 422 : 200));
    }
}
