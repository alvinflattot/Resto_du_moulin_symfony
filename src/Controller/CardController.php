<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Page;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\BrowserKit\Response;

class CardController extends AbstractController
{
    /**
     * @Route("/notre-carte", name="card")
     */
    public function card()
    {
        return $this->render('card/card.html.twig', [
        ]);
    }

    /**
     * @Route("/notre-carte/{type}/", name="card_type", requirements={"id"="\d+"})
     */
    public function meal(Page $page)
    {

        return $this->render('card/card.html.twig', [
            'page' => $page
        ]);
    }

    /**
    * Page admin permettant de modifier le contenu des pages de menu du restaurant
    *
    * @Route("/modification-menu/{type}", name="card_edit")
    * @Security("is_granted('ROLE_ADMIN')")
    */
    public function cardEdit(Page $page, request $request)
    {
        // Création du formulaire de modification d'une page menu 
        $form = $this->createForm(PageType::class, $page);

        // Liaison des données de requête (POST) avec le formulaire
        $form->handleRequest($request);

         // Si le formulaire est envoyé et n'a pas d'erreur
        if($form->isSubmitted() && $form->isValid()){

            // Sauvegarde des changements faits dans la page via le manager général des entités
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            // Message flash de type "success"
            $this->addFlash('success', 'Menu modifié avec succès !');

            // Redirection vers la page de la page modifié
            return $this->redirectToRoute('card_type', [ 'type' => $page->getType() ]);

        }

        // Appel de la vue en lui envoyant le formulaire à afficher
        return $this->render('card/editCard.html.twig', [
            'form' => $form->createView(),
            'page' => $page
        ]);
    }

    /**
     * @Route("/test-json/", name="test_json")
     */
    public function testJson(Request $request)
    {
        $mealType = $request->request->get('mealType');

        $pageRepo = $this->getDoctrine()->getRepository(Page::class);
        $page = $pageRepo->findOneByType($mealType);

        return $this->json([
            'page' => $page,
            // 'dataGet' => $mealType,
        ]);

    }

    /**
     * @Route("/testcard/", name="test_card")
     */
    public function testCard()
    {
        $pageRepo = $this->getDoctrine()->getRepository(Page::class);
        $pages = $pageRepo->findAll();
        
        return $this->render('card/cardTest.html.twig', [
            'pages' => $pages
        ]);
    }

}