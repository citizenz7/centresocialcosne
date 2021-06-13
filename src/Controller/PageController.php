<?php

namespace App\Controller;

use App\Entity\Page;
use App\Form\PageType;
use App\Repository\PageRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/pages", name="page_index", methods={"GET"})
     */
    public function index(Request $request, PageRepository $pageRepository, PaginatorInterface $paginator): Response
    {
        $donnees = $this->getDoctrine()->getRepository(Page::class)->findBy([],['id' => 'DESC']);

        $pages = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            5 // Nombre de résultats par page
        );

        return $this->render('page/index.html.twig', [
            'pages' => $pages,
        ]);
    }

    /**
     * @Route("/admin/pages", name="page_admin_index", methods={"GET"})
     */
    public function indexAdmin(Request $request, PageRepository $pageRepository, PaginatorInterface $paginator)
    {
        $donnees = $this->getDoctrine()->getRepository(Page::class)->findBy([],['id' => 'DESC']);

        $pages = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            5 // Nombre de résultats par page
        );

        return $this->render('page/index.admin.html.twig', [
            'pages' => $pages,
        ]);
    }

    /**
     * @Route("/admin/pages/new", name="page_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $page = new Page();
        $form = $this->createForm(PageType::class, $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Upload fichier 1 
            $uploadedFile1 = $form['file1']->getData();
            if ($uploadedFile1) {
                $destination1 = $this->getParameter("pages_files_directory");

                $originalFile1name = pathinfo($uploadedFile1->getClientOriginalName(), PATHINFO_FILENAME);
                $newFile1name = $originalFile1name.'-'.uniqid().'.'.$uploadedFile1->guessExtension();

                $uploadedFile1->move(
                    $destination1,
                    $newFile1name
                );
                $page->setFile1($newFile1name);
            }

            // Upload fichier 2 
            $uploadedFile2 = $form['file2']->getData();
            if ($uploadedFile2) {
                $destination2 = $this->getParameter("pages_files_directory");

                $originalFile2name = pathinfo($uploadedFile2->getClientOriginalName(), PATHINFO_FILENAME);
                $newFile2name = $originalFile2name.'-'.uniqid().'.'.$uploadedFile2->guessExtension();

                $uploadedFile2->move(
                    $destination2,
                    $newFile2name
                );
                $page->setFile2($newFile2name);
            }

            // Upload fichier 3
            $uploadedFile3 = $form['file3']->getData();
            if ($uploadedFile3) {
                $destination3 = $this->getParameter("pages_files_directory");

                $originalFile3name = pathinfo($uploadedFile3->getClientOriginalName(), PATHINFO_FILENAME);
                $newFile3name = $originalFile3name.'-'.uniqid().'.'.$uploadedFile3->guessExtension();

                $uploadedFile3->move(
                    $destination3,
                    $newFile3name
                );
                $page->setFile3($newFile3name);
            }

            // Upload fichier 4
            $uploadedFile4 = $form['file4']->getData();
            if ($uploadedFile4) {
                $destination4 = $this->getParameter("pages_files_directory");

                $originalFile4name = pathinfo($uploadedFile4->getClientOriginalName(), PATHINFO_FILENAME);
                $newFile4name = $originalFile4name.'-'.uniqid().'.'.$uploadedFile4->guessExtension();

                $uploadedFile4->move(
                    $destination4,
                    $newFile4name
                );
                $page->setFile4($newFile4name);
            }

            // Upload fichier 5
            $uploadedFile5 = $form['file5']->getData();
            if ($uploadedFile5) {
                $destination5 = $this->getParameter("pages_files_directory");

                $originalFile5name = pathinfo($uploadedFile5->getClientOriginalName(), PATHINFO_FILENAME);
                $newFile5name = $originalFile5name.'-'.uniqid().'.'.$uploadedFile5->guessExtension();

                $uploadedFile5->move(
                    $destination5,
                    $newFile5name
                );
                $page->setFile5($newFile5name);
            }

            $entityManager = $this->getDoctrine()->getManager();

            // Date de création de la page
            $page->setCreatedAt(new \DateTime());

            // Auteur de la page
            $page->setAuteur($this->getUser());

            $entityManager->persist($page);
            $entityManager->flush();

            return $this->redirectToRoute('page_index');
        }

        return $this->render('page/new.html.twig', [
            'page' => $page,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/pages/{slug}", name="page_show", methods={"GET"})
     */
    public function show(Page $page): Response
    {
        return $this->render('page/show.html.twig', [
            'page' => $page,
        ]);
    }

    /**
     * @Route("/admin/pages/{id}/edit", name="page_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Page $page): Response
    {
        $form = $this->createForm(PageType::class, $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Date de modification
            $page->setUpdatedAt(new \DateTime());

            // Upload fichier 1 
            $uploadedFile1 = $form['file1']->getData();
            if ($uploadedFile1) {

                // Puisqu'on a vérifié qu'il y a un changement de fichier, on supprime l'ancien fichier
                // On récupère le nom de l'ancien fichier
                $file1 = $page->getFile1();
                
                // On vérifie qu'il y un nom de fichier dans la base SQL
                if($file1) {
                    $nomFile1 = $this->getParameter("pages_files_directory") . '/' . $file1;
                    // On vérifie qu'il existe physiquement un fichier
                    if(file_exists($nomFile1)) {
                        unlink($nomFile1);
                    }
                }

                $destination1 = $this->getParameter("pages_files_directory");

                $originalFile1name = pathinfo($uploadedFile1->getClientOriginalName(), PATHINFO_FILENAME);
                $newFile1name = $originalFile1name.'-'.uniqid().'.'.$uploadedFile1->guessExtension();

                $uploadedFile1->move(
                    $destination1,
                    $newFile1name
                );
                $page->setFile1($newFile1name);
            }

            // Upload fichier 2 
            $uploadedFile2 = $form['file2']->getData();
            if ($uploadedFile2) {

                // Puisqu'on a vérifié qu'il y a un changement de fichier, on supprime l'ancien fichier
                // On récupère le nom de l'ancien fichier
                $file2 = $page->getFile2();
                
                // On vérifie qu'il y un nom de fichier dans la base SQL
                if($file2) {
                    $nomFile2 = $this->getParameter("pages_files_directory") . '/' . $file2;
                    // On vérifie qu'il existe physiquement un fichier
                    if(file_exists($nomFile2)) {
                        unlink($nomFile2);
                    }
                }

                $destination2 = $this->getParameter("pages_files_directory");

                $originalFile2name = pathinfo($uploadedFile2->getClientOriginalName(), PATHINFO_FILENAME);
                $newFile2name = $originalFile2name.'-'.uniqid().'.'.$uploadedFile2->guessExtension();

                $uploadedFile2->move(
                    $destination2,
                    $newFile2name
                );
                $page->setFile2($newFile2name);
            }

            // Upload fichier 3
            $uploadedFile3 = $form['file3']->getData();
            if ($uploadedFile3) {

                // Puisqu'on a vérifié qu'il y a un changement de fichier, on supprime l'ancien fichier
                // On récupère le nom de l'ancien fichier
                $file3 = $page->getFile3();
                
                // On vérifie qu'il y un nom de fichier dans la base SQL
                if($file3) {
                    $nomFile3 = $this->getParameter("pages_files_directory") . '/' . $file3;
                    // On vérifie qu'il existe physiquement un fichier
                    if(file_exists($nomFile3)) {
                        unlink($nomFile3);
                    }
                }

                $destination3 = $this->getParameter("pages_files_directory");

                $originalFile3name = pathinfo($uploadedFile3->getClientOriginalName(), PATHINFO_FILENAME);
                $newFile3name = $originalFile3name.'-'.uniqid().'.'.$uploadedFile3->guessExtension();

                $uploadedFile3->move(
                    $destination3,
                    $newFile3name
                );
                $page->setFile3($newFile3name);
            }

            // Upload fichier 4
            $uploadedFile4 = $form['file4']->getData();
            if ($uploadedFile4) {

                // Puisqu'on a vérifié qu'il y a un changement de fichier, on supprime l'ancien fichier
                // On récupère le nom de l'ancien fichier
                $file4 = $page->getFile4();
                
                // On vérifie qu'il y un nom de fichier dans la base SQL
                if($file4) {
                    $nomFile4 = $this->getParameter("pages_files_directory") . '/' . $file4;
                    // On vérifie qu'il existe physiquement un fichier
                    if(file_exists($nomFile4)) {
                        unlink($nomFile4);
                    }
                }

                $destination4 = $this->getParameter("pages_files_directory");

                $originalFile4name = pathinfo($uploadedFile4->getClientOriginalName(), PATHINFO_FILENAME);
                $newFile4name = $originalFile4name.'-'.uniqid().'.'.$uploadedFile4->guessExtension();

                $uploadedFile4->move(
                    $destination4,
                    $newFile4name
                );
                $page->setFile4($newFile4name);
            }

            // Upload fichier 5
            $uploadedFile5 = $form['file5']->getData();
            if ($uploadedFile5) {

                // Puisqu'on a vérifié qu'il y a un changement de fichier, on supprime l'ancien fichier
                // On récupère le nom de l'ancien fichier
                $file5 = $page->getFile5();
                
                // On vérifie qu'il y un nom de fichier dans la base SQL
                if($file5) {
                    $nomFile5 = $this->getParameter("pages_files_directory") . '/' . $file5;
                    // On vérifie qu'il existe physiquement un fichier
                    if(file_exists($nomFile5)) {
                        unlink($nomFile5);
                    }
                }
                
                $destination5 = $this->getParameter("pages_files_directory");

                $originalFile5name = pathinfo($uploadedFile5->getClientOriginalName(), PATHINFO_FILENAME);
                $newFile5name = $originalFile5name.'-'.uniqid().'.'.$uploadedFile5->guessExtension();

                $uploadedFile5->move(
                    $destination5,
                    $newFile5name
                );
                $page->setFile5($newFile5name);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('page_index');
        }

        return $this->render('page/edit.html.twig', [
            'page' => $page,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/pages/{id}", name="page_delete", methods={"POST"})
     */
    public function delete(Request $request, Page $page): Response
    {
        // Suppression file1
        $pageFile1 = $page->getFile1();
        // On vérifie qu'il y un nom de fichier dans la base SQL
        if($pageFile1) {
            $nomFile1 = $this->getParameter("pages_files_directory") . '/' . $pageFile1;
            // On vérifie qu'il existe physiquement un fichier
            if(file_exists($nomFile1)) {
                unlink($nomFile1);
            }
        }

        // Suppression file2
        $pageFile2 = $page->getFile2();
        // On vérifie qu'il y un nom de fichier dans la base SQL
        if($pageFile2) {
            $nomFile2 = $this->getParameter("pages_files_directory") . '/' . $pageFile2;
            // On vérifie qu'il existe physiquement un fichier
            if(file_exists($nomFile2)) {
                unlink($nomFile2);
            }
        }

        // Suppression file3
        $pageFile3 = $page->getFile3();
        // On vérifie qu'il y un nom de fichier dans la base SQL
        if($pageFile3) {
            $nomFile3 = $this->getParameter("pages_files_directory") . '/' . $pageFile3;
            // On vérifie qu'il existe physiquement un fichier
            if(file_exists($nomFile3)) {
                unlink($nomFile3);
            }
        }

        // Suppression file4
        $pageFile4 = $page->getFile4();
        // On vérifie qu'il y un nom de fichier dans la base SQL
        if($pageFile4) {
            $nomFile4 = $this->getParameter("pages_files_directory") . '/' . $pageFile4;
            // On vérifie qu'il existe physiquement un fichier
            if(file_exists($nomFile4)) {
                unlink($nomFile4);
            }
        }

        // Suppression file5
        $pageFile5 = $page->getFile5();
        // On vérifie qu'il y un nom de fichier dans la base SQL
        if($pageFile5) {
            $nomFile5 = $this->getParameter("pages_files_directory") . '/' . $pageFile5;
            // On vérifie qu'il existe physiquement un fichier
            if(file_exists($nomFile5)) {
                unlink($nomFile5);
            }
        }

        if ($this->isCsrfTokenValid('delete'.$page->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($page);
            $entityManager->flush();
        }

        return $this->redirectToRoute('page_index');
    }
}
