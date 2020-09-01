<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ContactType;
use App\Recaptcha\RecaptchaValidator;
use Symfony\Component\Form\FormError;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, \Swift_Mailer $mailer, RecaptchaValidator $recaptcha)
    {

        //création d'un formulaire de contact
        $form = $this->createForm(ContactType::class);

        // Liaison des données de requête (POST) avec le formulaire
        $form->handleRequest($request);

        // Si le formulaire a été envoyé
        if ($form->isSubmitted() ) {

            // Si le captcha n'est pas valide, on crée une nouvelle erreur dans le formulaire (ce qui l'empêchera de créer l'article et affichera l'erreur)
            // $request->request->get('g-recaptcha-response')  -----> code envoyé par le captcha dont la méthode verify() a besoin
            // $request->server->get('REMOTE_ADDR') -----> Adresse IP de l'utilisateur dont la méthode verify() a besoin
            if(!$recaptcha->verify( $request->request->get('g-recaptcha-response'), $request->server->get('REMOTE_ADDR') )){

                // Ajout d'une nouvelle erreur manuellement dans le formulaire
                $form->addError(new FormError('Le Captcha doit être validé !'));
            }

            // Si le formulaire ne contient par d'erreur, l'article sera bien créé
            if($form->isValid()){

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
                $this->addFlash('success', 'Votre message a bien été envoyé');

                //redirection
                return $this->redirectToRoute('home');

            }

        }

        return $this->render('contact/contact.html.twig', [
            'contactForm' => $form->createView(),
        ]);
    }
}
