<?php

namespace App\Controller;

use App\Entity\Activite;
use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\ActiviteRepository;
use App\Repository\CategorieRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    /**
     * @Route("/categories", name="categorie_index", methods={"GET"})
     */
    public function index(Request $request, CategorieRepository $categoriesRepository, ActiviteRepository $activiteRepository, PaginatorInterface $paginator): Response
    {
        $donnees = $this->getDoctrine()->getRepository(Categorie::class)->findBy([],['id' => 'DESC']);
        $categories = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            5 // Nombre de résultats par page
        );

        return $this->render('categorie/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/admin/categories", name="categorie_admin_index", methods={"GET"})
     */
    public function indexCategories(Request $request, CategorieRepository $categoriesRepository, PaginatorInterface $paginator): Response
    {
        $donnees = $this->getDoctrine()->getRepository(Categorie::class)->findBy([],['id' => 'DESC']);

        $categories = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            5 // Nombre de résultats par page
        );

        return $this->render('categorie/index.admin.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/admin/categories/new", name="categorie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $categorie = new Categorie();

        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // UPLOAD IMAGE
            $uploadedFile = $form['image']->getData();

            if ($uploadedFile) {
                $destination = $this->getParameter("categories_images_directory");

                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();

                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
                $categorie->setImage($newFilename);
            }

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($categorie);
            $entityManager->flush();

            return $this->redirectToRoute('categorie_index');
        }

        return $this->render('categorie/new.html.twig', [
            'categorie' => $categorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/categories/{slug}", name="categorie_show", methods={"GET"})
     */
    public function show(Categorie $categorie): Response
    {
        return $this->render('categorie/show.html.twig', [
            'categorie' => $categorie,
        ]);
    }

    /**
     * @Route("/admin/categories/{id}/edit", name="categorie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Categorie $categorie): Response
    {
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // UPLOAD IMAGE
            $uploadedFile = $form['image']->getData();

            if ($uploadedFile) {
                $destination = $this->getParameter("categories_images_directory");

                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();

                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
                $categorie->setImage($newFilename);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorie_index');
        }

        return $this->render('categorie/edit.html.twig', [
            'categorie' => $categorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/categories/{id}", name="categorie_delete", methods={"POST"})
     */
    public function delete(Request $request, Categorie $categorie): Response
    {
        // Suppression de l'image
        $image = $categorie->getImage();
        // On vérifie qu'il y un nom d'image dans la base SQL
        if($image) {
            $nomImage = $this->getParameter("categories_images_directory") . '/' . $image;
            // On vérifie qu'il existe physiquement une image
            if(file_exists($nomImage)) {
                unlink($nomImage);
            }
        }

        if ($this->isCsrfTokenValid('delete'.$categorie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categorie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categorie_index');
    }
}
