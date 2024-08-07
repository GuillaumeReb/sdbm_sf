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

use Doctrine\ORM\Tools\Pagination\Paginator;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/typebiere')]
class TypebiereController extends AbstractController
{
    #[Route('/', name: 'app_typebiere_index', methods: ['GET'])]
    public function index(TypebiereRepository $typebiereRepository, PaginatorInterface $paginator, Request $request): Response
    {
        // Debut pagination

        $queryBuilder = $typebiereRepository->createQueryBuilder('t');

        $pagination = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1), // Numéro de la page, par défaut 1
            10 // Limite de lignes par page
        );

        return $this->render('typebiere/index.html.twig', [
            'pagination' => $pagination,


        // Fin pagination

        // return $this->render('typebiere/index.html.twig', [
        //     'typebieres' => $typebiereRepository->findAll(),
        ]);
       
    }

    #[Route('/new', name: 'app_typebiere_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typebiere = new Typebiere();
        $form = $this->createForm(TypebiereType::class, $typebiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // ici coder les exeptions
            try{
                $entityManager->persist($typebiere);
                $entityManager->flush();
                $this->addFlash('success', 'Le type de bière a été ajouté avec succès.');

            }catch(\Exception $e){
                $this->addFlash('danger', 'La couleur n\'a pas été ajoutée.');
                // dd($e); 
                // Aide as trouver le code erreur UNIQ_.......
                if (($e->getCode()== 1062)){
                    if (strpos($e->getMessage(), "UNIQ_871959C27E0E9D47")) {
                        $this->addFlash('danger', 'Le nom doit êtres unique.');
                    }
                   
                }

            }
           

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
