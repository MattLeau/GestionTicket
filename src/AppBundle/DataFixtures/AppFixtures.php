<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\user;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
            $utilisateur = new user();
            $utilisateur->setNom('MESNAGE');
            $utilisateur->setPrenom('Matthieu ');

            $utilisateur->setIdEmploye(99);
            $utilisateur->setRole("Directeur");
            $utilisateur->setMdp("bonjour");
            $utilisateur->setUserName("MattLeau");
            $manager->persist($utilisateur);
            $manager->flush();

    }
}
