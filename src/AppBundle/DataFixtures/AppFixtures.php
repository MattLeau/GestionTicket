<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\projets;
use AppBundle\Entity\taches;
use AppBundle\Entity\user;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $utilisateursDirecteur = [];
        for ($i = 0; $i < 3; $i++) {
            $utilisateur = new user();
            $role = "Directeur";
            $utilisateur->setUsername("Loup-" . $i);
            $utilisateur->setEmail("Email" . $i . "@ticket.com");
            $utilisateur->setPassword("Dir_password" . $i);
            $utilisateur->setRoles([$role]);
            $utilisateur->setEnabled(1);
            $utilisateur->setMetier('Directeur');
            $manager->persist($utilisateur);
            $manager->flush();

            $utilisateursDirecteur[] = $utilisateur;
        }

        $utilisateursDeveloppeur = [];
        for ($i = 3; $i < 13; $i++) {
            $role = "Developpeur";
            $utilisateur = new user();
            $utilisateur->setUsername("Mouton-" . $i);
            $utilisateur->setEmail("Email" . $i . "ticket.com");
            $utilisateur->setPassword("Dev_password" . $i);
            $utilisateur->setEnabled(1);
            $utilisateur->setRoles([$role]);
            $utilisateur->setMetier('Developpeur');

            $manager->persist($utilisateur);
            $manager->flush();

            $utilisateursDeveloppeur[] = $utilisateur;
        }

        for ($i = 0; $i < 3; $i++) {
            $projet = new projets();
            $projet->setNomProjet("Faire le site d'ecoContruct" . $i);
            $projet->setEntreprise("EcoConstruct");
            $projet->setChef("Loup-" . $i);
            $projet->setDateDebut($i . "/" . $i . "/2018");
            $projet->setDateFin($i . "/" . $i . "/2019");

            $manager->persist($projet);
            $manager->flush();
        }

        for ($i = 0; $i < 3; $i++) {
            for ($j = 3; $j < 10; $j++) {
                $tache = new taches();
                $tache->setProjet("Faire le site d'ecoContruct" . $i);
                if ($j < 3) {
                    $tache->setEvolution("Fini");
                    $tache->setDescription("Créer la cahier des charges");
                } elseif ($j < 6) {
                    $tache->setEvolution("En cours");
                    $tache->setDescription("Créer les interfaces");
                } else {
                    $tache->setEvolution("Pas commencé");
                    $tache->setDescription("Livrer au client");
                }
                $tache->setAffectation("Mouton-" . $j);
                $manager->persist($tache);
                $manager->flush();
            }

        }
    }
}
