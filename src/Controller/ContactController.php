<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ContactType;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, \Swift_Mailer $mailer)
    {

        //création d'un formulaire de contact
        $form = $this->createForm(ContactType::class);

        // Liaison des données de requête (POST) avec le formulaire
        $form->handleRequest($request);

        // Si le formulaire a été envoyé
        if ($form->isSubmitted() && $form->isValid()) {

            $contact = $form->getData();

            //ici envoie du mail
            $message = (new \Swift_Message('Nouveau Contact'))
                //on attribue l'expéditeur
                ->setFrom($contact['email'])

                // on attribut le destinataire
                ->setTo('petillot.emilie@gmail.com')

                // on crée le message
                ->setBody(
                    $this->renderView(
                        'mails/contact-mail.html.twig', compact('contact')
                    ),
                    'text/html'
                )
            ;

            //on envoie le message
            $mailer->send($message);

            // Message flash de succès
            $this->addFlash('success', 'Votre message bien été envoyeé');

            //redirection
            return $this->redirectToRoute('home');

        }

        return $this->render('contact/contact.html.twig', [
            'contactForm' => $form->createView(),
        ]);
    }
}
