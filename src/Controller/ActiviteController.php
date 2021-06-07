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

/**
 * @Route("/activite")
 */
class ActiviteController extends AbstractController
{
    /**
     * @Route("/", name="activite_index", methods={"GET"})
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
     * @Route("/new", name="activite_new", methods={"GET","POST"})
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

            // Date de création de l'article
            $activite->setCreatedAt(new \DateTime());

            // Auteur de l'article
            $activite->setAuteur($this->getUser());

            $entityManager->persist($activite);
            $entityManager->flush();

            return $this->redirectToRoute('activite_index');
        }

        return $this->render('activite/new.html.twig', [
            'activite' => $activite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="activite_show", methods={"GET"})
     */
    public function show(Activite $activite): Response
    {
        return $this->render('activite/show.html.twig', [
            'activite' => $activite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="activite_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Activite $activite): Response
    {
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
             
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('activite_index');
        }

        return $this->render('activite/edit.html.twig', [
            'activite' => $activite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="activite_delete", methods={"POST"})
     */
    public function delete(Request $request, Activite $activite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$activite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($activite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('activite_index');
    }
}
