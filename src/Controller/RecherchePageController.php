<?php

namespace App\Controller;

use App\Form\RecherchePageType;
use App\Repository\PageRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecherchePageController extends AbstractController
{
    /**
     * @Route("/recherche/page", name="recherche_page")
     */
    public function index(Request $request, PageRepository $repo, PaginatorInterface $paginator): Response
    {
        $searchForm = $this->createForm(RecherchePageType::class);
        $searchForm->handleRequest($request);

        $donnees = $repo->findPages();

        if ($searchForm->isSubmitted() && $searchForm->isValid())
        {
            $titre = $searchForm->getData()->getTitre();
            $donnees = $repo->search($titre);
        }

        // Paginate the results of the query
        $pages = $paginator->paginate(
            $donnees, // Doctrine Query, not results
            $request->query->getInt('page', 1), // Define the page parameter
            10 // Items per page
        );

        return $this->render('recherche_page/index.html.twig', [
            'controller_name' => 'RecherchePageController',
            'pages' => $pages,
            'searchForm' => $searchForm->createView()
        ]);
    }
}
