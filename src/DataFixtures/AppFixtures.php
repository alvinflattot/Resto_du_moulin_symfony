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
            ->setContent('liste des plats a remplir')
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
            ->setContent('liste des desserts a remplir')
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
            ->setContent('liste des entrees a remplir')
        ;

        // Enregistrement de la nouvelle page auprès de Doctrine
        $manager->persist($entree);

        /////////////////////////////////////////////////////////////

        // Création d'une nouvelle page 
        $emporter = new Page();

        //hydratation de la nouvelle page
        $emporter
            ->setType('emporter')
            ->setTitle('Carte des emporters')
            ->setContent(' a remplir')
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
            ->setContent(' a remplir')
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
            ->setContent(' a remplir')
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
            ->setEmail('a@a.a')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->encoder->encodePassword($admin, 'Aaaaaa1+') )
        ;

        $manager->persist($admin);

        // Sauvegarde en BDD
        $manager->flush();
    }
}
