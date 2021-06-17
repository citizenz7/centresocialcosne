<?php

namespace App\Controller;

use App\Entity\NewsletterUser;
use App\Form\NewsletterUserType;
use App\Repository\NewsletterUserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/newsletter/user")
 */
class NewsletterUserController extends AbstractController
{
    /**
     * @Route("/", name="newsletter_user_index", methods={"GET"})
     */
    public function index(Request $request, NewsletterUserRepository $newsletterUserRepository, PaginatorInterface $paginator): Response
    {
        $donnees = $this->getDoctrine()->getRepository(NewsletterUser::class)->findBy([],['id' => 'DESC']);

        $newsletter_users = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            5 // Nombre de résultats par page
        );

        return $this->render('newsletter_user/index.html.twig', [
            //'newsletter_users' => $newsletterUserRepository->findAll(),
            'newsletter_users' => $newsletter_users,
        ]);
    }

    /**
     * @Route("/new", name="newsletter_user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $newsletterUser = new NewsletterUser();
        $form = $this->createForm(NewsletterUserType::class, $newsletterUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            // Date de création de l'activité
            $newsletterUser->setCreatedAt(new \DateTime());

            $entityManager->persist($newsletterUser);
            $entityManager->flush();

            return $this->redirectToRoute('newsletter_user_index');
        }

        return $this->render('newsletter_user/new.html.twig', [
            'newsletter_user' => $newsletterUser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="newsletter_user_show", methods={"GET"})
     */
    public function show(NewsletterUser $newsletterUser): Response
    {
        return $this->render('newsletter_user/show.html.twig', [
            'newsletter_user' => $newsletterUser,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="newsletter_user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, NewsletterUser $newsletterUser): Response
    {
        $form = $this->createForm(NewsletterUserType::class, $newsletterUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('newsletter_user_index');
        }

        return $this->render('newsletter_user/edit.html.twig', [
            'newsletter_user' => $newsletterUser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="newsletter_user_delete", methods={"POST"})
     */
    public function delete(Request $request, NewsletterUser $newsletterUser): Response
    {
        if ($this->isCsrfTokenValid('delete'.$newsletterUser->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($newsletterUser);
            $entityManager->flush();
        }

        return $this->redirectToRoute('newsletter_user_index');
    }
}
