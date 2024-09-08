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
use Symfony\Component\String\Slugger\SluggerInterface;

class AddController extends AbstractController
{
    #[Route('/administration/nouvel-article', name: 'app_back_office_biography_add')]
    public function index(Request                $request,
                          EntityManagerInterface $entityManager,
                          FileUploaderService    $fileUploaderService,
                          SluggerInterface       $slugger,
                          BiographyRepository    $biographyRepository): Response
    {
        $biography = new Biography();
        $form = $this->createForm(BiographyType::class, $biography);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $biographyRepository->addBiography($biography);

            /** @var UploadedFile $photoFile */
            $photoFile = $form->get('photo')->getData();
            if($photoFile) {
                $photoFileName = $fileUploaderService->upload($photoFile, 'biography', 'biography-' . strtolower($slugger->slug($biography->getPosition())));
                $biography->setPhoto($photoFileName);
            }
            $entityManager->persist($biography);
            $entityManager->flush();

            $this->addFlash('success', "L'article de biographie n°{$biography->getPosition()} a été créé");

            return $this->redirectToRoute('app_back_office_biography_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back_office/biography/add/index.html.twig', [
            'form' => $form->createView(),
        ], new Response(null, $form->isSubmitted() && !$form->isValid() ? 422 : 201));
    }
}
