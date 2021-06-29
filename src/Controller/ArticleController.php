<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ArticleController extends AbstractController
{
    /**
     * @Route("/articles", name="article_index", methods={"GET"})
     */
    public function index(Request $request, ArticleRepository $articleRepository, PaginatorInterface $paginator): Response
    {
        $donnees = $this->getDoctrine()->getRepository(Article::class)->findBy([],['id' => 'DESC']);

        $articles = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            5 // Nombre de résultats par page
        );

        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/admin/articles", name="article_admin_index", methods={"GET"})
     */
    public function indexAdmin(Request $request, ArticleRepository $articleRepository, PaginatorInterface $paginator)
    {
        //$donnees = $this->getDoctrine()->getRepository(Article::class)->findBy([],['id' => 'DESC']);

        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT p FROM App:Article p ORDER BY p.createdAt DESC";
        $donnees = $em->createQuery($dql);

        $articles = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            5 // Nombre de résultats par page
        );

        return $this->render('article/index.admin.html.twig', [
            'articles' => $articles,
        ]);
    }
 
    /**
     * @Route("/admin/articles/new", name="article_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Upload image
            $uploadedFile = $form['image']->getData();

            if ($uploadedFile) {
                $destination = $this->getParameter("articles_images_directory");

                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();

                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
                $article->setImage($newFilename);
            }

            // Upload fichier 1 
            $uploadedFile1 = $form['file1']->getData();
            if ($uploadedFile1) {
                $destination1 = $this->getParameter("articles_files_directory");

                $originalFile1name = pathinfo($uploadedFile1->getClientOriginalName(), PATHINFO_FILENAME);
                $newFile1name = $originalFile1name.'-'.uniqid().'.'.$uploadedFile1->guessExtension();

                $uploadedFile1->move(
                    $destination1,
                    $newFile1name
                );
                $article->setFile1($newFile1name);
            }

            // Upload fichier 2 
            $uploadedFile2 = $form['file2']->getData();
            if ($uploadedFile2) {
                $destination2 = $this->getParameter("articles_files_directory");

                $originalFile2name = pathinfo($uploadedFile2->getClientOriginalName(), PATHINFO_FILENAME);
                $newFile2name = $originalFile2name.'-'.uniqid().'.'.$uploadedFile2->guessExtension();

                $uploadedFile2->move(
                    $destination2,
                    $newFile2name
                );
                $article->setFile2($newFile2name);
            }

            // Upload fichier 3
            $uploadedFile3 = $form['file3']->getData();
            if ($uploadedFile3) {
                $destination3 = $this->getParameter("articles_files_directory");

                $originalFile3name = pathinfo($uploadedFile3->getClientOriginalName(), PATHINFO_FILENAME);
                $newFile3name = $originalFile3name.'-'.uniqid().'.'.$uploadedFile3->guessExtension();

                $uploadedFile3->move(
                    $destination3,
                    $newFile3name
                );
                $article->setFile3($newFile3name);
            }

            $entityManager = $this->getDoctrine()->getManager();

            // Date de création de l'article
            $article->setCreatedAt(new \DateTime());

            // Auteur de l'article
            $article->setAuteur($this->getUser());

            // Nombre de vues à 1 
            $article->setViews('1');

            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('article_admin_index');
        }

        return $this->render('article/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/articles/{slug}", name="article_show", methods={"GET"})
     */
    public function show(Article $article, Request $request, EntityManagerInterface $manager): Response
    {
        // Views: +1 à chaque visite
        $read = $article->getViews() +1;
        $article->setViews($read);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($article);
        $entityManager->flush();

        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }
 
    /**
     * @Route("/admin/articles/{id}/edit", name="article_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Article $article): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Date de modification
            $article->setUpdatedAt(new \DateTime());

            // Upload image
            $uploadedFile = $form['image']->getData();

            if ($uploadedFile) {
                // Puisqu'on a vérifié qu'il y a un changement d'image, on supprime l'ancienne image

                // On récupère le nom de l'ancienne image
                $image = $article->getImage();
                // On vérifie qu'il y un nom d'image dans la base SQL
                if($image) {
                    $nomImage = $this->getParameter("articles_images_directory") . '/' . $image;
                    // On vérifie qu'il existe physiquement une image
                    if(file_exists($nomImage)) {
                        unlink($nomImage);
                    }
                }

                // On upload la nouvelle image...
                $destination = $this->getParameter("articles_images_directory");

                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();

                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
                $article->setImage($newFilename);
            }

            // Upload fichier 1 
            $uploadedFile1 = $form['file1']->getData();
            if ($uploadedFile1) {

                // Puisqu'on a vérifié qu'il y a un changement de fichier, on supprime l'ancien fichier
                // On récupère le nom de l'ancien fichier
                $file1 = $article->getFile1();

                // On vérifie qu'il y un nom de fichier dans la base SQL
                if($file1) {
                    $nomFile1 = $this->getParameter("articles_files_directory") . '/' . $file1;
                    // On vérifie qu'il existe physiquement un fichier
                    if(file_exists($nomFile1)) {
                        unlink($nomFile1);
                    }
                }

                $destination1 = $this->getParameter("articles_files_directory");

                $originalFile1name = pathinfo($uploadedFile1->getClientOriginalName(), PATHINFO_FILENAME);
                $newFile1name = $originalFile1name.'-'.uniqid().'.'.$uploadedFile1->guessExtension();

                $uploadedFile1->move(
                    $destination1,
                    $newFile1name
                );
                $article->setFile1($newFile1name);
            }

            // Upload fichier 2 
            $uploadedFile2 = $form['file2']->getData();
            if ($uploadedFile2) {

                // Puisqu'on a vérifié qu'il y a un changement de fichier, on supprime l'ancien fichier
                // On récupère le nom de l'ancien fichier
                $file2 = $article->getFile2();
                
                // On vérifie qu'il y un nom de fichier dans la base SQL
                if($file2) {
                    $nomFile2 = $this->getParameter("articles_files_directory") . '/' . $file2;
                    // On vérifie qu'il existe physiquement un fichier
                    if(file_exists($nomFile2)) {
                        unlink($nomFile2);
                    }
                }

                $destination2 = $this->getParameter("articles_files_directory");

                $originalFile2name = pathinfo($uploadedFile2->getClientOriginalName(), PATHINFO_FILENAME);
                $newFile2name = $originalFile2name.'-'.uniqid().'.'.$uploadedFile2->guessExtension();

                $uploadedFile2->move(
                    $destination2,
                    $newFile2name
                );
                $article->setFile2($newFile2name);
            }

            // Upload fichier 3
            $uploadedFile3 = $form['file3']->getData();
            if ($uploadedFile3) {

                // Puisqu'on a vérifié qu'il y a un changement de fichier, on supprime l'ancien fichier
                // On récupère le nom de l'ancien fichier
                $file3 = $article->getFile3();
                
                // On vérifie qu'il y un nom de fichier dans la base SQL
                if($file3) {
                    $nomFile3 = $this->getParameter("artciles_files_directory") . '/' . $file3;
                    // On vérifie qu'il existe physiquement un fichier
                    if(file_exists($nomFile3)) {
                        unlink($nomFile3);
                    }
                }

                $destination3 = $this->getParameter("articles_files_directory");

                $originalFile3name = pathinfo($uploadedFile3->getClientOriginalName(), PATHINFO_FILENAME);
                $newFile3name = $originalFile3name.'-'.uniqid().'.'.$uploadedFile3->guessExtension();

                $uploadedFile3->move(
                    $destination3,
                    $newFile3name
                );
                $article->setFile3($newFile3name);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_admin_index');
        }

        return $this->render('article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/articles/{id}/delimage", name="article_delete_image", methods={"GET"})
     */
    public function deleteImage(Request $request, Article $article): Response
    {
        // Delete article's image in folder
        $image = $article->getImage();
        if($image) {
            $nomImage = $this->getParameter("articles_images_directory") . '/' . $image;
            if(file_exists($nomImage)) {
                unlink($nomImage);
            }
        }

        // Set image to "nothing" in DB
        $article->setImage('');       
        $this->getDoctrine()->getManager()->flush();

        // Redirect to edit page
        $this->addFlash('image_delete', 'L\'image de l\'article a été supprimée avec succès.');
        return $this->redirectToRoute('article_edit', ['id' => $article->getId()]);
    }

    /**
     * @Route("admin/articles/{id}", name="article_delete", methods={"POST"})
     */
    public function delete(Request $request, Article $article): Response
    {
        // Suppression de l'image
        $image = $article->getImage();
        // On vérifie qu'il y un nom d'image dans la base SQL
        if($image) {
            $nomImage = $this->getParameter("articles_images_directory") . '/' . $image;
            // On vérifie qu'il existe physiquement une image
            if(file_exists($nomImage)) {
                unlink($nomImage);
            }
        }

        // Suppression file1
        $articleFile1 = $article->getFile1();
        // On vérifie qu'il y un nom de fichier dans la base SQL
        if($articleFile1) {
            $nomFile1 = $this->getParameter("articles_files_directory") . '/' . $articleFile1;
            // On vérifie qu'il existe physiquement un fichier
            if(file_exists($nomFile1)) {
                unlink($nomFile1);
            }
        }

        // Suppression file2
        $articleFile2 = $article->getFile2();
        // On vérifie qu'il y un nom de fichier dans la base SQL
        if($articleFile2) {
            $nomFile2 = $this->getParameter("articles_files_directory") . '/' . $articleFile2;
            // On vérifie qu'il existe physiquement un fichier
            if(file_exists($nomFile2)) {
                unlink($nomFile2);
            }
        }

        // Suppression file3
        $articleFile3 = $article->getFile3();
        // On vérifie qu'il y un nom de fichier dans la base SQL
        if($articleFile3) {
            $nomFile3 = $this->getParameter("articles_files_directory") . '/' . $articleFile3;
            // On vérifie qu'il existe physiquement un fichier
            if(file_exists($nomFile3)) {
                unlink($nomFile3);
            }
        }

        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('article_admin_index');
    }
}
