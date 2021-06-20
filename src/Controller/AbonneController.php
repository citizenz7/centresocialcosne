<?php

namespace App\Controller;

use App\Entity\Abonne;
use App\Form\AbonneType;
use App\Repository\AbonneRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/abonne")
 */
class AbonneController extends AbstractController
{
    /**
     * @Route("/", name="abonne_index", methods={"GET"})
     */
    public function index(Request $request, AbonneRepository $abonneRepository, PaginatorInterface $paginator): Response
    {
        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT p FROM App:Abonne p ORDER BY p.created_at DESC";
        $donnees = $em->createQuery($dql);

        $abonnes = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            5 // Nombre de résultats par page
        );

        return $this->render('abonne/index.html.twig', [
            'abonnes' => $abonnes,
        ]);
    }

    /**
     * @Route("/new", name="abonne_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $abonne = new Abonne();
        $form = $this->createForm(AbonneType::class, $abonne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            // Date de création de l'activité
            $abonne->setCreatedAt(new \DateTime());

            $entityManager->persist($abonne);
            $entityManager->flush();

            return $this->redirectToRoute('abonne_index');
        }

        return $this->render('abonne/new.html.twig', [
            'abonne' => $abonne,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="abonne_show", methods={"GET"})
     */
    public function show(Abonne $abonne): Response
    {
        return $this->render('abonne/show.html.twig', [
            'abonne' => $abonne,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="abonne_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Abonne $abonne): Response
    {
        $form = $this->createForm(AbonneType::class, $abonne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('abonne_index');
        }

        return $this->render('abonne/edit.html.twig', [
            'abonne' => $abonne,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="abonne_delete", methods={"POST"})
     */
    public function delete(Request $request, Abonne $abonne): Response
    {
        if ($this->isCsrfTokenValid('delete'.$abonne->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($abonne);
            $entityManager->flush();
        }

        return $this->redirectToRoute('abonne_index');
    }
}
