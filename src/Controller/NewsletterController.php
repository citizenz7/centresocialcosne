<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Entity\NewsletterUser;
use App\Form\NewsletterType;
use App\Repository\NewsletterRepository;
use App\Repository\NewsletterUserRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/newsletter")
 */
class NewsletterController extends AbstractController
{
    /**
     * @Route("/", name="newsletter_index", methods={"GET"})
     */
    public function index(NewsletterRepository $newsletterRepository): Response
    {
        return $this->render('newsletter/index.html.twig', [
            'newsletters' => $newsletterRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="newsletter_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $newsletter = new Newsletter();
        $form = $this->createForm(NewsletterType::class, $newsletter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            // Date de création de l'activité
            $newsletter->setCreatedAt(new \DateTime());

            $entityManager->persist($newsletter);
            $entityManager->flush();

            return $this->redirectToRoute('newsletter_index');
        }

        return $this->render('newsletter/new.html.twig', [
            'newsletter' => $newsletter,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="newsletter_show", methods={"GET"})
     */
    public function show(Newsletter $newsletter): Response
    {
        return $this->render('newsletter/show.html.twig', [
            'newsletter' => $newsletter,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="newsletter_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Newsletter $newsletter): Response
    {
        $form = $this->createForm(NewsletterType::class, $newsletter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('newsletter_index');
        }

        return $this->render('newsletter/edit.html.twig', [
            'newsletter' => $newsletter,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/send/{id}", name="newsletter_send")
     */
    public function send(Newsletter $newsletter, NewsletterUser $newsletterUser, NewsletterUserRepository $repos, MailerInterface $mailer): Response
    {
        $abonnes = $this->getDoctrine()->getRepository(NewsletterUser::class)->findBy([],['id' => 'DESC']);

        foreach($abonnes as $abonne) {
            $email = (new TemplatedEmail())
                ->from('newsletter@centresocialcosne.org')
                ->to($abonne->getEmail())
                ->subject($newsletter->getTitre())
                ->htmlTemplate('email/newsletter.html.twig')
                ->context(compact('newsletter', 'abonne'))
            ;
            $mailer->send($email);
        }

        $entityManager = $this->getDoctrine()->getManager();

        // La newslleter est envoyée. On passe le isSent à true.
        $newsletter->setIsSent(true);

        $entityManager->persist($newsletter);
        $entityManager->flush();

        return $this->redirectToRoute('newsletter_index');
    }


    /**
     * @Route("/{id}", name="newsletter_delete", methods={"POST"})
     */
    public function delete(Request $request, Newsletter $newsletter): Response
    {
        if ($this->isCsrfTokenValid('delete'.$newsletter->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($newsletter);
            $entityManager->flush();
        }

        return $this->redirectToRoute('newsletter_index');
    }
}
