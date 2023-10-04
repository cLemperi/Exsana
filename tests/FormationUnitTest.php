<?php
/*
namespace App\Tests;

use DateTime;
use App\Entity\Category;
use App\Entity\Formations;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\ObjectifFormation;
use App\Entity\ProgrammeFormation;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class FormationUnitTest extends KernelTestCase
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     
    protected $container;

    public function setUp(): void
    {
        self::bootKernel();
        self::$container->get('doctrine')->getManager(); // initialize the ManagerInterface here
    }

    public function testIsTrue(): void
    {
        $formation = new Formations();
        $date = (new DateTime())->format('Y-m-d');
        $manager = $this->createMock(ObjectManager::class);
        $category = new Category();

        $categories = [$category];
        $randomCat = $categories[array_rand($categories)];

        $formation->setTitle('test formation')
            ->setPrice('150')
            ->setForWho('test pour qui')
            ->setPrerequisite('test prerequis')
            ->setDateFormation('2000-01-01')
            ->setSlug('test-formation')
            ->setDurationFormation(strval(mt_rand(1, 31)))
            ->setLocation('testcity')
            ->setCategory($randomCat)
            ->addObjectifFormation((new ObjectifFormation())->setName('test obj'))
            ->addProgrammeFormation((new ProgrammeFormation())->setName('test pgr'));


        $this->assertTrue($formation->getTitle() === 'test formation');
        $this->assertTrue($formation->getPrice() === '150');
        $this->assertTrue($formation->getForWho() === 'test pour qui');
        $this->assertTrue($formation->getPrerequisite() === 'test prerequis');
        $this->assertTrue($formation->getDateFormation() === '2000-01-01 ');
        $this->assertTrue($formation->getSlug() === 'test-formation');
        $this->assertTrue(
            intval($formation->getDurationFormation()) < 1 || intval($formation->getDurationFormation()) > 31
        );
        $this->assertTrue($formation->getLocation() === 'testcity');
        $this->assertTrue($formation->getCategory() === $randomCat);
        if ($formation->getObjectifFormations() !== null) {
            foreach ($formation->getObjectifFormations() as $objectifFormation) {
                $this->assertTrue($objectifFormation->getName() === 'test obj');
            }
        }
        if ($formation->getProgrammeFormations() !== null) {
            foreach ($formation->getProgrammeFormations() as $objectifFormation) {
                $this->assertTrue($objectifFormation->getName() === 'test pgr');
            }
        }
    }

    public function testIsFalse(): void
    {

        $formation = new Formations();
        $date = (new DateTime())->format('Y-m-d');
        $category = new Category();

        $categories = [$category];
        $randomCat = $categories[array_rand($categories)];
        $formation->setTitle('test formation')
            ->setPrice('150')
            ->setForWho('test pour qui')
            ->setPrerequisite('test prerequis')
            ->setDateFormation('2000-01-01')
            ->setSlug('test-formation')
            ->setDurationFormation(strval(mt_rand(1, 31)))
            ->setLocation('testcity')
            ->setCategory($randomCat)
            ->addObjectifFormation((new ObjectifFormation())->setName('test obj'))
            ->addProgrammeFormation((new ProgrammeFormation())->setName('test pgr'));


        $this->assertFalse($formation->getTitle() !== 'test formation');
        $this->assertFalse($formation->getPrice() !== '150');
        $this->assertFalse($formation->getForWho() !== 'test pour qui');
        $this->assertFalse($formation->getPrerequisite() !== 'test prerequis');
        $this->assertFalse(DateTime::createFromFormat('Y-m-d', $formation->getDateFormation()) === false);
        $this->assertFalse($formation->getSlug() !== 'test-formation');
        $this->assertFalse(intval(
            $formation->getDurationFormation()
        ) < 1 || intval($formation->getDurationFormation()) > 31);
        $this->assertFalse($formation->getLocation() !== 'testcity');
        $this->assertFalse($formation->getCategory() !== $randomCat);
        if ($formation->getObjectifFormations() !== null) {
            foreach ($formation->getObjectifFormations() as $objectifFormation) {
                $this->assertFalse($objectifFormation->getName() === 'test obj');
            }
        }
        if ($formation->getProgrammeFormations() !== null) {
            foreach ($formation->getProgrammeFormations() as $objectifFormation) {
                $this->assertFalse($objectifFormation->getName() === 'test obj');
            }
        }
    }
}

*/
