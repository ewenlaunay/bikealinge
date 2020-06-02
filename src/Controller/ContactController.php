<?php

namespace App\Controller;

use App\Form\ContactType;
use Swift_Mailer;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @param Swift_Mailer $mailer
     * @return Response
     */
    public function index(Request $request, Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            // Ici nous enverrons l'e-mail
            $message = (new Swift_Message('Nouveau Contact'))
                //On attribue l'expediteur
                ->setFrom($contact['Email'])

                //On attribue le destinataire
                ->setTo('ewen.launay889@gmail.com')

                //On crée le message
                ->setBody(
                    $this->renderView(
                        'emails/contact.html.twig', compact('contact')
                    ),
                    'text/html'
                );
            //On envoie le message
            $mailer->send($message);

            $this->addFlash('message', 'Le message a bien été envoyé'); // Permet un message flash de renvoi
            return $this->redirectToRoute('homepage');
        }
        return $this->render('contact/index.html.twig', ['contactForm' => $form->createView()]);
    }

}