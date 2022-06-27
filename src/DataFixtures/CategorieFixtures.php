<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $generator = \Faker\Factory::create('fr_FR');
        $shortText = $generator->sentence($nbWords = 8, $variableNbWords = true);

        for ($i = 0; $i <= 7; $i++) {
            $manager->persist( 
                (new Category())
                ->setTitle($shortText)
                ->setDescription($generator->paragraph())
            );
        }

        $manager->flush();
    }
}
