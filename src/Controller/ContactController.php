<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $contactFormData = $form->getData();
            
            $message = (new Email())
                ->from($contactFormData['email'])
                ->to('contact@s2ii.xyz')
                ->subject('Message depuis centresocialcosne.org')
                ->html('<h3>Message envoyé depuis le site web du centre social</h3>' . '<b>De :</b> ' . $contactFormData['prenom'] . ' ' . $contactFormData['nom'] . '<br>' . '<b>E-mail :</b> ' . $contactFormData['email'] . '<br>' . '<b>Message</b> : <p>' . $contactFormData['message'] . '</p>', 'text/plain');
            
            $mailer->send($message);

            $this->addFlash('successContact', 'Votre message a bien été envoyé ! ');

            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/index.html.twig', [
            'our_form' => $form->createView()
        ]);
    }
}
