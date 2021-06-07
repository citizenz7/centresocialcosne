<?php

namespace App\Controller;

use App\Entity\Activite;
use App\Form\ActiviteType;
use App\Repository\ActiviteRepository;
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
    public function index(ActiviteRepository $activiteRepository): Response
    {
        return $this->render('activite/index.html.twig', [
            'activites' => $activiteRepository->findAll(),
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
     * @Route("/{id}", name="activite_show", methods={"GET"})
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
