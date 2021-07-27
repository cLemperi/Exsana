<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Formations;
use Faker;

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


        for($i = 0; $i <= 10;$i++){ 
         $formations = new Formations($shortText);
         $formations->setTitle($shortText)
         			->setDate(new \DateTime())
                    ->setPrice(mt_rand(10, 100))
                    ->setDuration(mt_rand(1,30))
                    ->setObjectifFormation($contentFormation)
                    ->setProgrammeFormmation($contentFormation)
                    ->setForWho($shortText)
                    ->setPrerequisite($shortText)
                    ->setDateAdd(new \DateTime())
                    ->setDateFormation($date)
                    ->setDurationFormation(mt_rand(1, 31))
                    ->setLocation($city);

            $manager->persist($formations);

        }

        
        $manager->flush();
    }
}
