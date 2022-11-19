<?php

namespace App\Tests;

use DateTime;
use App\Entity\Category;
use App\Entity\Formations;
use PHPUnit\Framework\TestCase;
use App\Entity\ObjectifFormation;
use App\Entity\ProgrammeFormation;
use Doctrine\Persistence\ObjectManager;
use PHPUnit\TextUI\XmlConfiguration\Constant;

class FormationUnitTest extends TestCase
{
    
    public function testIsTrue()
    {   
        $formation = new Formations;
        $date = new DateTime();
        $manager = new ObjectManager();
        $category = new Category();

        $categories = $this->$category = $manager->getRepository(Category::class)->findAll();
        $randomCat = $categories[array_rand($categories)];

    $formation->setTitle('test formation')
                ->setPrice(150)
                ->setDuration(25)
                ->setForWho(('test pour qui'))
                ->setPrerequisite(('test prerequis'))
                ->setDateFormation($date)
                ->setSlug(('test-formation'))
                ->setDurationFormation(mt_rand(1, 31))
                ->setLocation('testcity')
                ->setCategory($randomCat)
                ->addObjectifFormation((new ObjectifFormation())->setName('test obj'))
                ->addProgrammeFormation((new ProgrammeFormation())->setName('test pgr'));

        
                $this->assertTrue($formation->getTitle() === 'test formation');
                $this->assertTrue($formation->getPrice() === 'test formation');
                $this->assertTrue($formation->getDuration() === 'test formation');
                $this->assertTrue($formation->getForWho() === 'test formation');
                $this->assertTrue($formation->getPrerequisite() === 'test formation');
                $this->assertTrue($formation->getDateFormation() === 'test formation');
                $this->assertTrue($formation->getSlug() === 'test formation');
                $this->assertTrue($formation->getDurationFormation() === 'test formation');
                $this->assertTrue($formation->getLocation() === 'test formation');
                $this->assertTrue($formation->getCategory() === 'test formation');
                $this->assertTrue($formation->getObjectifFormations() === 'test formation');
                $this->assertTrue($formation->getProgrammeFormations() === 'test formation');
    }

    public function testIsFalse(){
    $formation = new Formations;
    $date = new DateTime();
    $manager = new ObjectManager();
    $category = new Category();

    $categories = $this->$category = $manager->getRepository(Category::class)->findAll();
    $randomCat = $categories[array_rand($categories)];
    $formation->setTitle('test formation')
                ->setPrice(150)
                ->setDuration(25)
                ->setForWho(('test pour qui'))
                ->setPrerequisite(('test prerequis'))
                ->setDateFormation($date)
                ->setSlug(('test-formation'))
                ->setDurationFormation(mt_rand(1, 31))
                ->setLocation('testcity')
                ->setCategory($randomCat)
                ->addObjectifFormation((new ObjectifFormation())->setName('test obj'))
                ->addProgrammeFormation((new ProgrammeFormation())->setName('test pgr'));

        
                $this->assertFalse($formation->getTitle() === 'test falseformation');
                $this->assertFalse($formation->getPrice() === 11);
                $this->assertFalse($formation->getDuration() === 22);
                $this->assertFalse($formation->getForWho() === 'test falseformation');
                $this->assertFalse($formation->getPrerequisite() === 'testfalse formation');
                $this->assertFalse($formation->getDateFormation() === new DateTime());
                $this->assertFalse($formation->getSlug() === 'test falseformation');
                $this->assertFalse($formation->getDurationFormation() === 'test falseformation');
                $this->assertFalse($formation->getLocation() === 'falsecity');
                $this->assertFalse($formation->getCategory() === 'Categorie');
                $this->assertFalse($formation->getObjectifFormations() === 'testobj');
                $this->assertFalse($formation->getProgrammeFormations() === 'testpgr');
    }
}
