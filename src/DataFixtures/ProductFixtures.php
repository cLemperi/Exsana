<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $generator = Factory::create('fr_FR');

        $product = $manager->getRepository(Product::class)->findAll();
        for ($index = 1; $index <= 10; $index++) {
            //$category = $categories[array_rand($categories)];
            $shortText = $generator->sentence($nbWords = 10, $variableNbWords = true) . $index;
            $product = (new Product())
                ->setTitle($shortText)
                ->setDescription($shortText)
                ->setPrice("40€")
                ->setBrand("TEST Fixtures")
                ->setImg("test")
                ->setProductCategory("Categorie 1")
                ->setSlug($generator->slug(3));
            $manager->persist($product);
        }
        $manager->flush();
    }
}
