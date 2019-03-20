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
            for ($i=0; $i<3; $i++) {
                $utilisateur = new user();
                $role = "Directeur";
                $utilisateur->setUsername("Loup-".$i);
                $utilisateur->setEmail("Email".$i);
                $utilisateur->setPassword("password".$i);
                $utilisateur->setRoles([$role]);

                $manager->persist($utilisateur);
                $manager->flush();

                $utilisateursDirecteur[] = $utilisateur;
            }

        $utilisateursDeveloppeur = [];
        for ($i=3; $i<13; $i++) {
            $role = "Developpeur";
            $utilisateur = new user();
            $utilisateur->setUsername("Loup-".$i);
            $utilisateur->setEmail("Email".$i);
            $utilisateur->setPassword("password".$i);
            $utilisateur->setRoles([$role]);

            $manager->persist($utilisateur);
            $manager->flush();

            $utilisateursDeveloppeur[] = $utilisateur;
        }

        $projets = [];
        $projet = new projets();
        $projet->setNomProjet("Construire un pont");
        $projet->setEntreprise("Veolia");
        $projet->setChef("RENARD-1");
        $projet->setDateDebut("15/05/2018");
        $projet->setDateFin("30/08/2019");
        $manager->persist($projet);
        $manager->flush();

        $projets = $projet;

        $projet = new projets();
        $projet->setNomProjet("Réparer la porte du musée");
        $projet->setEntreprise("Etat");
        $projet->setChef("RENARD-2");
        $projet->setDateDebut("18/08/2018");
        $projet->setDateFin("15/09/2019");
        $manager->persist($projet);
        $manager->flush();

        $projets = $projet;

        $projet = new projets();
        $projet->setNomProjet("Construire le magasin");
        $projet->setEntreprise("Carrefour");
        $projet->setChef("RENARD-3");
        $projet->setDateDebut("02/04/2018");
        $projet->setDateFin("03/07/2019");
        $manager->persist($projet);
        $manager->flush();

        $projets = $projet;


        $tache = new taches();
        $tache->setProjet("Construire le magasin");
        $tache->setEvolution("Fini");
        $tache->setDescription("Créer la cahier des charges");
        $tache->setAffectation(3);
        $manager->persist($tache);
        $manager->flush();

    }
}
