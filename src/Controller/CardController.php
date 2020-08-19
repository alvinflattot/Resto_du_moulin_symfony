<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use Symfony\Component\HttpFoundation\Request;

class CardController extends AbstractController
{
    /**
     * @Route("/notre-carte", name="card")
     */
    public function card()
    {

        $pageRepository = $this->getDoctrine()->getRepository(Page::class);
        
        return $this->render('card/card.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

}