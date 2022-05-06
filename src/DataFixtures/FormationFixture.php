<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Category;
use App\Entity\Formations;
use App\Entity\ObjectifFormation;
use App\Entity\ProgrammeFormation;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class FormationFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $generator = \Faker\Factory::create('fr_FR');
        
        //contennu formation
        $contentFormation = $generator->sentences($nb = 12, $asText = false);
        $duration = $generator->randomDigitNot(5);
        $shortText = $generator->sentence($nbWords = 8, $variableNbWords = true);
        $city = $generator->city;
        $date = $generator->dateTime('+0 days', '+2 years');
        
        $category = new Category();
        $formation = new Formations;
        $objectifFormations = new ObjectifFormation();
        $programmeFormation = new ProgrammeFormation();
        //Créer 3 catégorie
    for ($i = 0; $i <= 4; $i++) {
        $category = new Category();
        $category->setTitle($generator->sentence())
                     ->setDescription($generator->paragraph());
        $manager->persist($category);
    }

    

    //création de objectifformation
    

    for ($j = 0; $j <= mt_rand(3, 8);$j++) {
        $formations = new Formations();
            for ($a = 0; $a <= 12; $a++) {
                $objectifFormations = new ObjectifFormation();
                $programmeFormation = new ProgrammeFormation();
                $objectifFormations->setName($generator->sentence())
                                    ->setDescription($generator->sentence())
                                    ->setObjectifs($formation);
                $programmeFormation->setName($generator->sentence());     
             }
        $formations->setTitle($shortText)
                    ->setDate(new \DateTime())
                   ->setPrice(mt_rand(10, 100))
                   ->setDuration(mt_rand(1, 30))
                   ->setForWho($shortText)
                   ->setPrerequisite($shortText)
                   ->setDateFormation($date)
                   ->setDurationFormation(mt_rand(1, 31))
                   ->setLocation($city)
                   ->setCategory($category)
                   ->addObjectifFormation($objectifFormations);
        $manager->persist($formations);
    }
    
    $manager->flush();  

    }
               
}

