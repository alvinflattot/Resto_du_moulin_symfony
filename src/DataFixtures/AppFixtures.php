<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Page;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder=$encoder;
    }

    public function load(ObjectManager $manager)
    {

        // Création d'une nouvelle page 
        $plat = new Page();

        //hydratation de la nouvelle page
        $plat
            ->setType('plat')
            ->setTitle('Carte des plats')
            ->setContent('
                Pièce de boeuf grillé à la plancha,
                sauce époisses.
                16,50€
                
                Dos de thon snacké,
                concassé de tomate aux olives et basilic.
                15,50€
                
                Gigotin de volaille farci au lard fumé,
                jus au thym.
                12,50€
                
                Gouginettes de carpe "des Dombes" en friture,
                sauce tartare.
                14,50€
            ')
        ;

        // Enregistrement de la nouvelle page auprès de Doctrine
        $manager->persist($plat);

        /////////////////////////////////////////////////////////////

        // Création d'une nouvelle page 
        $dessert = new Page();

        //hydratation de la nouvelle page
        $dessert
            ->setType('dessert')
            ->setTitle('Carte des desserts')
            ->setContent('
                Assiette de fromages :
                Époisses, comté, chèvre frais
                6,50€
                
                Moelleux au chocolat coeur coulant
                et crème anglaise
                6,50€
                
                Parfait glacé au citron vert,
                coulis de fruits rouges
                6,50€
                
                Fromage blanc à la crème de la chèvrerie
                "Les Terres Chaudes".
                4,50€
                
                Café Gourmand
                6,50€
            ')
        ;

        // Enregistrement de la nouvelle page auprès de Doctrine
        $manager->persist($dessert);

        /////////////////////////////////////////////////////////////

        // Création d'une nouvelle page 
        $entree = new Page();

        //hydratation de la nouvelle page
        $entree
            ->setType('entree')
            ->setTitle('Carte des entrees')
            ->setContent('
                Bruschetta de poivrons marinés,
                saumon fumé et fromage frais.
                10,50€
                
                Salade campagnarde, oeuf poché,
                fromage de chèvre et jambon cru.
                7,50€
                
                Cabillaud émietté au safran
                et petits légumes.
                9,50€
            ')
        ;

        // Enregistrement de la nouvelle page auprès de Doctrine
        $manager->persist($entree);

        /////////////////////////////////////////////////////////////

        // Création d'une nouvelle page 
        $emporter = new Page();

        //hydratation de la nouvelle page
        $emporter
            ->setType('emporter')
            ->setTitle('A emporter')
            ->setContent('
                Gourmandises du week-end
                (sur commande uniquement)
                
                Plats du chef à emporter (entrées, plats, menus)
                
                Tous les détails sur notre page Facebook ou en nous téléphonant (03 85 57 18 85)
            ')
        ;

        // Enregistrement de la nouvelle page auprès de Doctrine
        $manager->persist($emporter);

        /////////////////////////////////////////////////////////////
        
        // Création d'une nouvelle page 
        $petitChef = new Page();

        //hydratation de la nouvelle page
        $petitChef
            ->setType('petit-chef')
            ->setTitle('Menu des petits chefs')
            ->setContent('
                11,50 €

                Menu enfant jusqu\'à 10 ans
                
                Entrée
                Plat
                Fromage ou Dessert 
                
                > Demander la suggestion du chef < 
                
                Nos menus sont taxes et service compris. Boissons non comprises dans le menu.
                
                Tout changement dans le menu sera facturé 3,50 €.
            ')
        ;

        // Enregistrement de la nouvelle page auprès de Doctrine
        $manager->persist($petitChef);

        /////////////////////////////////////////////////////////////
        
        // Création d'une nouvelle page 
        $menuDuJour = new Page();

        //hydratation de la nouvelle page
        $menuDuJour
            ->setType('menu-du-jour')
            ->setTitle('Menu du jour')
            ->setContent('
                Entrée, Plat, Fromages ou Dessert

                15,00 €
                
                Entrée, Plat, Fromages et Dessert
                
                16,00 €
                
                Café offert 
            ')
        ;

        // Enregistrement de la nouvelle page auprès de Doctrine
        $manager->persist($menuDuJour);

        /////////////////////////////////////////////////////////////

        $test = new User();

        $test
            ->setEmail('c@c.c')
            ->setPassword($this->encoder->encodePassword($test, 'Aaaaaa1+') )
        ;

        $manager->persist($test);
        
        /////////////////////////////////////////////////////////////

        $admin = new User();

        $admin
            ->setEmail('petillot.emilie@gmail.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->encoder->encodePassword($admin, 'emilieadminrestaurant1+') )
        ;

        $manager->persist($admin);

        // Sauvegarde en BDD
        $manager->flush();
    }
}
