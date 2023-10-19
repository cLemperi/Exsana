<?php

namespace App\Tests\Entity\Unit;

use App\Entity\Formations;
use App\Entity\ObjectifFormation;
use PHPUnit\Framework\TestCase;
use App\Entity\ProgrammeFormation;
use App\Entity\User;

class FormationsTest extends TestCase
{
    public function testIsValid(): void
    {
        $formation = new Formations();

        $formation->setTitle('Test Formation');
        $formation->setPrice('Free');
        $formation->setForWho('Everyone');
        $formation->setPrerequisite('None');
        $formation->setDateFormation('2023-09-29');
        $formation->setDurationFormation('3 hours');
        $formation->setLocation('Online');
        $formation->setIntervenant('John Doe');
        $formation->setEvaluation('Good');
        $formation->setPublicAndAccessCondition('Public');

        $this->assertTrue($formation->getTitle() === 'Test Formation');
        $this->assertTrue($formation->getPrice() === 'Free');
        $this->assertTrue($formation->getForWho() === 'Everyone');
        $this->assertTrue($formation->getPrerequisite() === 'None');
        $this->assertTrue($formation->getDateFormation() === '2023-09-29');
        $this->assertTrue($formation->getDurationFormation() === '3 hours');
        $this->assertTrue($formation->getLocation() === 'Online');
        $this->assertTrue($formation->getIntervenant() === 'John Doe');
        $this->assertTrue($formation->getEvaluation() === 'Good');
        $this->assertTrue($formation->getPublicAndAccessCondition() === 'Public');
    }

    public function testNotValid(): void
    {
        $formation = new Formations();

        $formation->setTitle('Wrong');
        $formation->setPrice('Wrong');
        $formation->setForWho('Wrong');
        $formation->setPrerequisite('Wrong');

        $this->assertFalse($formation->getTitle() === 'Test Formation');
        $this->assertFalse($formation->getPrice() === 'Free');
        $this->assertFalse($formation->getForWho() === 'Everyone');
        $this->assertFalse($formation->getPrerequisite() === 'None');
    }

    public function testIsEmpty(): void
    {
        $formation = new Formations();

        $this->assertEmpty($formation->getTitle());
        $this->assertEmpty($formation->getPrice());
        $this->assertEmpty($formation->getForWho());
        $this->assertEmpty($formation->getPrerequisite());
        $this->assertEmpty($formation->getDateFormation());
        $this->assertEmpty($formation->getDurationFormation());
        $this->assertEmpty($formation->getLocation());
        $this->assertEmpty($formation->getIntervenant());
        $this->assertEmpty($formation->getEvaluation());
        $this->assertEmpty($formation->getPublicAndAccessCondition());
    }

    public function testCanAddAndRetrieveProgrammeFormations(): void
    {
        $formation = new Formations();

        // Créer une première instance de ProgrammeFormation
        $programmeFormation1 = new ProgrammeFormation();
        $programmeFormation1->setName('Programme 1');
        $programmeFormation1->setTitle('Title 1');
        $programmeFormation1->setProgramme($formation);

        // Créer une deuxième instance de ProgrammeFormation
        $programmeFormation2 = new ProgrammeFormation();
        $programmeFormation2->setName('Programme 2');
        $programmeFormation2->setTitle('Title 2');
        $programmeFormation2->setProgramme($formation);

        // Ajout des ProgrammeFormations à la formation
        $formation->addProgrammeFormation($programmeFormation1);
        $formation->addProgrammeFormation($programmeFormation2);

        // Assert
        $this->assertCount(2, $formation->getProgrammeFormations());
        $this->assertSame($programmeFormation1, $formation->getProgrammeFormations()[0]);
        $this->assertSame($programmeFormation2, $formation->getProgrammeFormations()[1]);
    }

    public function testCanAddAndRetrieveObjectifFormations(): void
    {
        $formation = new Formations();

        // Créer une première instance de ObjectifsFormation
        $objectifFormation1 = new ObjectifFormation();
        $objectifFormation1->setName('Objectif 1');
        $objectifFormation1->setTitle('Title 1');
        $objectifFormation1->setObjectifs($formation);

        // Créer une deuxième instance de ObjectifsFormation
        $objectifFormation2 = new ObjectifFormation();
        $objectifFormation2->setName('Objectif 2');
        $objectifFormation2->setTitle('Title 2');
        $objectifFormation2->setObjectifs($formation);

        // Ajout des ObjectifsFormations à la formation
        $formation->addObjectifFormation($objectifFormation1);
        $formation->addObjectifFormation($objectifFormation2);

        // Assert
        $this->assertCount(2, $formation->getObjectifFormations());
        $this->assertSame($objectifFormation1, $formation->getObjectifFormations()[0]);
        $this->assertSame($objectifFormation2, $formation->getObjectifFormations()[1]);
    }

    public function testCanAddUserToFormation(): void
    {

        $formation = new Formations();
        $user = new User();
        $user->setUsername('TestNickname');
        $user->setPassword('testPassword');
        $user->setRoles(['ROLE_USER']);
        $user->setSex('Mr');
        $user->setFirstName('TestFirstname');
        $user->setLastName('TestLastname');
        $user->setEmail('test@test.com');
        $user->setJob('testJob');
        $user->setPhone('0635656565');
        $user->setRppsCode('12343');
        $user->setPostalCode('14310');
        $user->setCity('testCity');
        $user->setStreet('rue du test')
            ->setProfil('test');




        $formation->addUser($user);
        $this->assertTrue($formation->getUsers()->contains($user), "User was not added to the formation.");
        $this->assertCount(1, $formation->getUsers(), "Number of users in formation is not as expected.");
        $this->assertSame($user, $formation->getUsers()[0]);
    }
}
