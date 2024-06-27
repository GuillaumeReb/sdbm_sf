<?php

namespace App\Controller;

use App\Entity\Typebiere;
use App\Form\TypebiereType;
use App\Repository\TypebiereRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/typebiere')]
class TypebiereController extends AbstractController
{
    #[Route('/', name: 'app_typebiere_index', methods: ['GET'])]
    public function index(TypebiereRepository $typebiereRepository): Response
    {
        return $this->render('typebiere/index.html.twig', [
            'typebieres' => $typebiereRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_typebiere_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typebiere = new Typebiere();
        $form = $this->createForm(TypebiereType::class, $typebiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typebiere);
            $entityManager->flush();

            return $this->redirectToRoute('app_typebiere_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('typebiere/new.html.twig', [
            'typebiere' => $typebiere,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_typebiere_show', methods: ['GET'])]
    public function show(Typebiere $typebiere): Response
    {
        return $this->render('typebiere/show.html.twig', [
            'typebiere' => $typebiere,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_typebiere_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Typebiere $typebiere, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypebiereType::class, $typebiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_typebiere_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('typebiere/edit.html.twig', [
            'typebiere' => $typebiere,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_typebiere_delete', methods: ['POST'])]
    public function delete(Request $request, Typebiere $typebiere, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typebiere->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($typebiere);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_typebiere_index', [], Response::HTTP_SEE_OTHER);
    }
}
