<?php

namespace App\Controller;

use App\Entity\Activite;
use App\Form\ActiviteType;
use App\Repository\ActiviteRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ActiviteController extends AbstractController
{
    /**
     * @Route("/activites", name="activite_index", methods={"GET"})
     */
    public function index(Request $request, ActiviteRepository $activiteRepository, PaginatorInterface $paginator): Response
    {
        $donnees = $this->getDoctrine()->getRepository(Activite::class)->findBy([],['id' => 'DESC']);

        $activites = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            5 // Nombre de résultats par page
        );

        return $this->render('activite/index.html.twig', [
            'activites' => $activites,
        ]);
    }

    /**
     * @Route("/admin/activites", name="activite_admin_index", methods={"GET"})
     */
    public function indexAdmin(Request $request, ActiviteRepository $activiteRepository, PaginatorInterface $paginator): Response
    {
        //$donnees = $this->getDoctrine()->getRepository(Activite::class)->findBy([],['id' => 'DESC']);
        

        $em = $this->getDoctrine()->getManager();
        // Les data issues de la table activite sont ordonnées par updatedAt
        $dql = "SELECT p FROM App:Activite p ORDER BY p.id DESC";
        $donnees = $em->createQuery($dql);

        $activites = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            5 // Nombre de résultats par page
        );

        return $this->render('activite/index.admin.html.twig', [
            'activites' => $activites,
        ]);
    }

    /**
     * @Route("/admin/activites/new", name="activite_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $activite = new Activite();
        $form = $this->createForm(ActiviteType::class, $activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Upload image
            $uploadedFile = $form['image']->getData();

            if ($uploadedFile) {
                $destination = $this->getParameter("activites_images_directory");

                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();

                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
                $activite->setImage($newFilename);
            }

            // Upload fichier 1 
            $uploadedFile1 = $form['file1']->getData();
            if ($uploadedFile1) {
                $destination1 = $this->getParameter("activites_files_directory");

                $originalFile1name = pathinfo($uploadedFile1->getClientOriginalName(), PATHINFO_FILENAME);
                $newFile1name = $originalFile1name.'-'.uniqid().'.'.$uploadedFile1->guessExtension();

                $uploadedFile1->move(
                    $destination1,
                    $newFile1name
                );
                $activite->setFile1($newFile1name);
            }

            // Upload fichier 2 
            $uploadedFile2 = $form['file2']->getData();
            if ($uploadedFile2) {
                $destination2 = $this->getParameter("activites_files_directory");

                $originalFile2name = pathinfo($uploadedFile2->getClientOriginalName(), PATHINFO_FILENAME);
                $newFile2name = $originalFile2name.'-'.uniqid().'.'.$uploadedFile2->guessExtension();

                $uploadedFile2->move(
                    $destination2,
                    $newFile2name
                );
                $activite->setFile2($newFile2name);
            }

            // Upload fichier 3
            $uploadedFile3 = $form['file3']->getData();
            if ($uploadedFile3) {
                $destination3 = $this->getParameter("activites_files_directory");

                $originalFile3name = pathinfo($uploadedFile3->getClientOriginalName(), PATHINFO_FILENAME);
                $newFile3name = $originalFile3name.'-'.uniqid().'.'.$uploadedFile3->guessExtension();

                $uploadedFile3->move(
                    $destination3,
                    $newFile3name
                );
                $activite->setFile3($newFile3name);
            }

            $entityManager = $this->getDoctrine()->getManager();

            // Date de création de l'activité
            $activite->setCreatedAt(new \DateTime());

            $entityManager->persist($activite);
            $entityManager->flush();

            return $this->redirectToRoute('activite_admin_index');
        }

        return $this->render('activite/new.html.twig', [
            'activite' => $activite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/activites/{slug}", name="activite_show", methods={"GET"})
     */
    public function show(Activite $activite): Response
    {
        return $this->render('activite/show.html.twig', [
            'activite' => $activite,
        ]);
    }

    /**
     * @Route("/admin/activites/{id}/edit", name="activite_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Activite $activite): Response
    {
        $form = $this->createForm(ActiviteType::class, $activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Date de modification
            $activite->setUpdatedAt(new \DateTime());

            // Upload image
            $uploadedFile = $form['image']->getData();

             if ($uploadedFile) {
                // Puisqu'on a vérifié qu'il y a un changement d'image, on supprime l'ancienne image

                // On récupère le nom de l'ancienne image
                $image = $activite->getImage();
                // On vérifie qu'il y un nom d'image dans la base SQL
                if($image) {
                    $nomImage = $this->getParameter("activites_images_directory") . '/' . $image;
                    // On vérifie qu'il existe physiquement une image
                    if(file_exists($nomImage)) {
                        unlink($nomImage);
                    }
                }

                 $destination = $this->getParameter("activites_images_directory");
 
                 $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                 $newFilename = $originalFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();
 
                 $uploadedFile->move(
                     $destination,
                     $newFilename
                 );
                 $activite->setImage($newFilename);
             }

            // Upload fichier 1 
            $uploadedFile1 = $form['file1']->getData();
            if ($uploadedFile1) {

                // Puisqu'on a vérifié qu'il y a un changement de fichier, on supprime l'ancien fichier
                // On récupère le nom de l'ancien fichier
                $file1 = $activite->getFile1();

                // On vérifie qu'il y un nom de fichier dans la base SQL
                if($file1) {
                    $nomFile1 = $this->getParameter("activites_files_directory") . '/' . $file1;
                    // On vérifie qu'il existe physiquement un fichier
                    if(file_exists($nomFile1)) {
                        unlink($nomFile1);
                    }
                }

                $destination1 = $this->getParameter("activites_files_directory");

                $originalFile1name = pathinfo($uploadedFile1->getClientOriginalName(), PATHINFO_FILENAME);
                $newFile1name = $originalFile1name.'-'.uniqid().'.'.$uploadedFile1->guessExtension();

                $uploadedFile1->move(
                    $destination1,
                    $newFile1name
                );
                $activite->setFile1($newFile1name);
            }

            // Upload fichier 2 
            $uploadedFile2 = $form['file2']->getData();
            if ($uploadedFile2) {

                // Puisqu'on a vérifié qu'il y a un changement de fichier, on supprime l'ancien fichier
                // On récupère le nom de l'ancien fichier
                $file2 = $activite->getFile2();
                
                // On vérifie qu'il y un nom de fichier dans la base SQL
                if($file2) {
                    $nomFile2 = $this->getParameter("activites_files_directory") . '/' . $file2;
                    // On vérifie qu'il existe physiquement un fichier
                    if(file_exists($nomFile2)) {
                        unlink($nomFile2);
                    }
                }

                $destination2 = $this->getParameter("activites_files_directory");

                $originalFile2name = pathinfo($uploadedFile2->getClientOriginalName(), PATHINFO_FILENAME);
                $newFile2name = $originalFile2name.'-'.uniqid().'.'.$uploadedFile2->guessExtension();

                $uploadedFile2->move(
                    $destination2,
                    $newFile2name
                );
                $activite->setFile2($newFile2name);
            }

            // Upload fichier 3
            $uploadedFile3 = $form['file3']->getData();
            if ($uploadedFile3) {

                // Puisqu'on a vérifié qu'il y a un changement de fichier, on supprime l'ancien fichier
                // On récupère le nom de l'ancien fichier
                $file3 = $activite->getFile3();
                
                // On vérifie qu'il y un nom de fichier dans la base SQL
                if($file3) {
                    $nomFile3 = $this->getParameter("activites_files_directory") . '/' . $file3;
                    // On vérifie qu'il existe physiquement un fichier
                    if(file_exists($nomFile3)) {
                        unlink($nomFile3);
                    }
                }

                $destination3 = $this->getParameter("activites_files_directory");

                $originalFile3name = pathinfo($uploadedFile3->getClientOriginalName(), PATHINFO_FILENAME);
                $newFile3name = $originalFile3name.'-'.uniqid().'.'.$uploadedFile3->guessExtension();

                $uploadedFile3->move(
                    $destination3,
                    $newFile3name
                );
                $activite->setFile3($newFile3name);
            }
             
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('activite_admin_index');
        }

        return $this->render('activite/edit.html.twig', [
            'activite' => $activite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/activites/{id}", name="activite_delete", methods={"POST"})
     */
    public function delete(Request $request, Activite $activite): Response
    {
            // Suppression de l'image
            $image = $activite->getImage();
            // On vérifie qu'il y un nom d'image dans la base SQL
            if($image) {
                $nomImage = $this->getParameter("activites_images_directory") . '/' . $image;
                // On vérifie qu'il existe physiquement une image
                if(file_exists($nomImage)) {
                    unlink($nomImage);
                }
            }

            // Suppression file1
            $activiteFile1 = $activite->getFile1();
            // On vérifie qu'il y un nom de fichier dans la base SQL
            if($activiteFile1) {
                $nomFile1 = $this->getParameter("activites_files_directory") . '/' . $activiteFile1;
                // On vérifie qu'il existe physiquement un fichier
                if(file_exists($nomFile1)) {
                    unlink($nomFile1);
                }
            }

            // Suppression file2
            $activiteFile2 = $activite->getFile2();
            // On vérifie qu'il y un nom de fichier dans la base SQL
            if($activiteFile2) {
                $nomFile2 = $this->getParameter("activites_files_directory") . '/' . $activiteFile2;
                // On vérifie qu'il existe physiquement un fichier
                if(file_exists($nomFile2)) {
                    unlink($nomFile2);
                }
            }

            // Suppression file3
            $activiteFile3 = $activite->getFile3();
            // On vérifie qu'il y un nom de fichier dans la base SQL
            if($activiteFile3) {
                $nomFile3 = $this->getParameter("activites_files_directory") . '/' . $activiteFile3;
                // On vérifie qu'il existe physiquement un fichier
                if(file_exists($nomFile3)) {
                    unlink($nomFile3);
                }
            }


        if ($this->isCsrfTokenValid('delete'.$activite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($activite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('activite_admin_index');
    }
}