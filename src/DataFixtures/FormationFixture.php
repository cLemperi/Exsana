<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Category;
use App\Entity\Formations;
use App\Entity\ObjectifFormation;
use App\Entity\ProgrammeFormation;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\DomCrawler\Form;

class FormationFixture extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $generator = \Faker\Factory::create('fr_FR');
        //contennu formation
        
        $categories = $manager->getRepository(Category::class)->findAll();
        //Créer 8 catégorie
        for ($index = 1; $index <= 10; $index++){
            $category = $categories[array_rand($categories)];
            $shortText = $generator->sentence($nbWords = 10, $variableNbWords = true ) . $index;
            $city = $generator->city;
            $date = $generator->dateTime('+0 days', '+2 years');
            $manager->persist(
                (new Formations())
                    ->setTitle($shortText)
                    ->setPrice(mt_rand(10, 100))
                    ->setDuration(mt_rand(1, 30))
                    ->setForWho($shortText)
                    ->setPrerequisite($shortText)
                    ->setDateFormation($date)
                    ->setSlug($generator->slug(3))
                    ->setDurationFormation(mt_rand(1, 31))
                    ->setLocation($city)
                    ->setCategory($category)
                    ->addObjectifFormation((new ObjectifFormation())->setName($shortText))
                    ->addObjectifFormation((new ObjectifFormation())->setName($shortText))
                    ->addObjectifFormation((new ObjectifFormation())->setName($shortText))
                    ->addObjectifFormation((new ObjectifFormation())->setName($shortText))
                    ->addProgrammeFormation((new ProgrammeFormation())->setName($shortText))
                    ->addProgrammeFormation((new ProgrammeFormation())->setName($shortText))
                    ->addProgrammeFormation((new ProgrammeFormation())->setName($shortText))
                    ->addProgrammeFormation((new ProgrammeFormation())->setName($shortText))
                );
        } 
        $manager->flush();

        
    }
}

