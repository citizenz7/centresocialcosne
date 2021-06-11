<?php

namespace App\Controller;

use App\Form\RechercheArticleType;
use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechercheArticleController extends AbstractController
{
    /**
     * @Route("/recherche/article", name="recherche_article")
     */
    public function index(Request $request, ArticleRepository $repo, PaginatorInterface $paginator): Response
    {
        $searchForm = $this->createForm(RechercheArticleType::class);
        $searchForm->handleRequest($request);

        $donnees = $repo->findArticles();

        if ($searchForm->isSubmitted() && $searchForm->isValid())
        {
            $titre = $searchForm->getData()->getTitre();
            $donnees = $repo->search($titre);
        }

        $articles = $paginator->paginate(
            $donnees, // Doctrine Query, not results
            $request->query->getInt('page', 1), // Define the page parameter
            10 // Items per page
        );

        return $this->render('recherche_article/index.html.twig', [
            'controller_name' => 'RechercheArticleController',
            'articles' => $articles,
            'searchForm' => $searchForm->createView()
        ]);
    }
}
