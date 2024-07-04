<?php

namespace App\Controller;

use App\Entity\Fabricant;
use App\Form\FabricantType;
use App\Repository\FabricantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Doctrine\ORM\Tools\Pagination\Paginator;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/fabricant')]
class FabricantController extends AbstractController
{
    #[Route('/', name: 'app_fabricant_index', methods: ['GET'])]
    public function index(FabricantRepository $fabricantRepository, PaginatorInterface $paginator, Request $request): Response
    {
        // Debut pagination avec KnpPaginatorBundle

        $queryBuilder = $fabricantRepository->createQueryBuilder('t');

        $pagination = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1), // Numéro de la page, par défaut 1
            10 // Limite de lignes par page
        );

        return $this->render('fabricant/index.html.twig', [
            'pagination' => $pagination,


        // Fin pagination

        // return $this->render('fabricant/index.html.twig', [
        //     'fabricants' => $fabricantRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_fabricant_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $fabricant = new Fabricant();
        $form = $this->createForm(FabricantType::class, $fabricant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // ici coder les exeptions
            try{
                $entityManager->persist($fabricant);
                $entityManager->flush();
                $this->addFlash('success', 'Le fabricant a été ajouté avec succès.');

            }catch(\Exception $e){
                $this->addFlash('danger', 'Le fabricant n\'a pas été ajouté.');
                // dd($e); 
                // Aide as trouver le code erreur UNIQ_.......
                if (($e->getCode()== 1062)){
                    if (strpos($e->getMessage(), "UNIQ_D740A26943B1D328")) {
                        $this->addFlash('danger', 'Le nom doit êtres unique.');
                    }
                   
                }

            }
            

            return $this->redirectToRoute('app_fabricant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fabricant/new.html.twig', [
            'fabricant' => $fabricant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fabricant_show', methods: ['GET'])]
    public function show(Fabricant $fabricant): Response
    {
        return $this->render('fabricant/show.html.twig', [
            'fabricant' => $fabricant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_fabricant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Fabricant $fabricant, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FabricantType::class, $fabricant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_fabricant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fabricant/edit.html.twig', [
            'fabricant' => $fabricant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fabricant_delete', methods: ['POST'])]
    public function delete(Request $request, Fabricant $fabricant, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fabricant->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($fabricant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_fabricant_index', [], Response::HTTP_SEE_OTHER);
    }
}
