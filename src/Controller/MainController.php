<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;


class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('main/home.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/infos-legales", name="infos_legales")
     */
    public function infos()
    {
        
        return $this->render('main/infos-legales.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/envoyer-un-email-de-test/", name="send_email_test")
     */
    public function sendEmailTest(MailerInterface $mailer){

        // Le mailer est récupéré automatiquement en paramètre par autowiring dans $mailer

        // Création du mail
        $email = (new TemplatedEmail())
            ->from(new Address('expediteur@exemple.fr', 'noreply'))
            ->to('destinataire@gmail.com')
            ->subject('Sujet du mail')
            ->htmlTemplate('test/test.html.twig')    // Fichier twig du mail en version html
            ->textTemplate('test/test.txt.twig')     // Fichier twig du mail en version text
            /* Il est possible de faire passer aux deux templates twig des variables en ajoutant le code suivant :
            ->context([
                'fruits' => ['Pomme', 'Cerise', 'Poire']
            ])
            */
        ;

        // Envoi du mail
        $mailer->send($email);

        // Affichage d'une vue quelquonque
        return $this->render('main/sendEmailTest.html.twig');
    }

    
        

}
