<?php

namespace App\Controller;

use App\Entity\Activite;
use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Page;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $data_articles = $this->getDoctrine()->getRepository(Article::class)->findBy([],['id' => 'desc']);
        $articles = $paginator->paginate(
            $data_articles,
            $request->query->getInt('page', 1),
            3
        );

        $data_activites = $this->getDoctrine()->getRepository(Activite::class)->findBy([],['titre' => 'desc']);
        $activites = $paginator->paginate(
            $data_activites,
            $request->query->getInt('page', 1),
            3
        );

        $data_pages = $this->getDoctrine()->getRepository(Page::class)->findBy([],['id' => 'asc']);
        $pages = $paginator->paginate(
            $data_pages,
            $request->query->getInt('page', 1),
            3
        );

        $categories = $this->getDoctrine()->getRepository(Categorie::class)->findBy([],['id' => 'asc']);


        return $this->render('home/index.html.twig', [
            'articles' => $articles,
            'activites' => $activites,
            'pages' => $pages,
            'categories' => $categories,
        ]);
    }
}
