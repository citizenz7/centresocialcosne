<?php

namespace App\twig;

use App\Repository\ActiviteRepository;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use App\Repository\PageRepository;
use App\Repository\UserRepository;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class sidebarExtension extends AbstractExtension
{
    /**
     * @var ActiviteRepository
     */
    private $activiteRepository;

    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     * @var CategorieRepository
     */
    private $categorieRepository;

    /**
     * @var PageRepository
     */
    private $pageRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;


    /**
     * @var Environment
     */
    private $twig;


    public function __construct(
        ActiviteRepository $activiteRepository,
        ArticleRepository $articleRepository, 
        CategorieRepository $categorieRepository,
        PageRepository $pageRepository,
        UserRepository $userRepository,
        Environment $twig
    )
    {
        $this->activiteRepository = $activiteRepository;
        $this->articleRepository = $articleRepository;
        $this->categorieRepository = $categorieRepository;
        $this->pageRepository = $pageRepository;
        $this->userRepository = $userRepository;
        $this->twig = $twig;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('sidebar', [$this, 'getSidebar'], ['is_safe' => ['html']])
        ];
    }
  
    public function getSidebar(): string
    {
        $activitesAll = $this->activiteRepository->findAll();
        $articles = $this->articleRepository->popularArticles();
        $articlesAll = $this->articleRepository->findAll();
        $categories = $this->categorieRepository->sidebarCategories();
        $pages = $this->pageRepository->findAll();
        $users = $this->userRepository->findAll();
        $views = $this->articleRepository->totalViews();

        try {
            return $this->twig->render('home/sidebar.html.twig',
                compact('activitesAll', 'articles', 'articlesAll', 'categories', 'pages', 'users', 'views'));
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }
    }
}