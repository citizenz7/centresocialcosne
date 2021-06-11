<?php

namespace App\Controller;

use App\Form\RechercheActiviteType;
use App\Repository\ActiviteRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechercheActiviteController extends AbstractController
{
    /**
     * @Route("/recherche/activite", name="recherche_activite")
     */
    public function index(Request $request, ActiviteRepository $repo, PaginatorInterface $paginator): Response
    {
        $searchForm = $this->createForm(RechercheActiviteType::class);
        $searchForm->handleRequest($request);

        $donnees = $repo->findActivites();

        if ($searchForm->isSubmitted() && $searchForm->isValid())
        {
            $titre = $searchForm->getData()->getTitre();
            $donnees = $repo->search($titre);
        }

        // Paginate the results of the query
        $activites = $paginator->paginate(
            $donnees, // Doctrine Query, not results
            $request->query->getInt('page', 1), // Define the page parameter
            10 // Items per page
        );

        return $this->render('recherche_activite/index.html.twig', [
            'controller_name' => 'RechercheActiviteController',
            'activites' => $activites,
            'searchForm' => $searchForm->createView()
        ]);
    }
}
