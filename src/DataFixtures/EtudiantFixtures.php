<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EtudiantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Créer un objet Faker
        $faker = Factory::create("fr_FR");
        // Générer 100 étudiants
        for ($i=1;$i <= 100;$i++) {
            // Créer un etudiant
            $etudiant = new Etudiant();
            $etudiant->setPrenom($faker->firstName());
            $etudiant->setNom($faker->lastName());
            $etudiant->setEmail($faker->email());
            $etudiant->setDateNaissance($faker->dateTimeBetween('-30 years','-17 years'));
            // Persister l'etudiant
            // Doctrine va génerer un INSERT INTO ...
            $manager->persist($etudiant);
        }
        $manager->flush();
    }
}
