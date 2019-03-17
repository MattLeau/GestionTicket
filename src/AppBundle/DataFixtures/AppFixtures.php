<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\user;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
            $utilisateursDirecteur = [];
            for ($i=0; $i<3; $i++) {
                $utilisateur = new user();
                $utilisateur->setNom('RENARD-'.$i);
                $utilisateur->setPrenom('Antoine-'.$i);

                $utilisateur->setIdEmploye(60+$i);
                $utilisateur->setRole("Directeur");
                $utilisateur->setUserName("Loup-".$i);
                $utilisateur->setMdp("DevWeb");

                $manager->persist($utilisateur);
                $manager->flush();

                $utilisateursDirecteur[] = $utilisateur;
            }

        $utilisateursDeveloppeur = [];
        for ($i=0; $i<10; $i++) {
            $utilisateur = new user();
            $utilisateur->setNom('MESNAGE-'.$i);
            $utilisateur->setPrenom('Matthieu-'.$i);

            $utilisateur->setIdEmploye(70+$i);
            $utilisateur->setRole("Developpeur");
            $utilisateur->setUserName("Matelot-".$i);
            $utilisateur->setMdp("Python");

            $manager->persist($utilisateur);
            $manager->flush();

            $utilisateursDeveloppeur[] = $utilisateur;
        }

    }
}
