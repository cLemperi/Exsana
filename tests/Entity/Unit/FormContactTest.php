<?php

namespace App\Tests\Entity\Unit;

use App\Entity\FormContact;
use PHPUnit\Framework\TestCase;

class FormContactTest extends TestCase
{
    public function testIsValid(): void
    {

        $FormContact = new FormContact();

        $FormContact->setSex('Monsieur')
            ->setNickname('Nicolas')
            ->setLastname('Dupont')
            ->setPhone('0332123456')
            ->setEmail('nicolas@example.com')
            ->setAdresse('123 Rue de Paris')
            ->setCity('Paris')
            ->setPostalCode('75001')
            ->setRequest('Information request')
            ->setMessage('Hello!')
            ->setIsArchived(false);

            $this->assertEquals('Monsieur', $FormContact->getSex());
            $this->assertEquals('Nicolas', $FormContact->getNickname());
            $this->assertEquals('Dupont', $FormContact->getLastname());
            $this->assertEquals('0332123456', $FormContact->getPhone());
            $this->assertEquals('nicolas@example.com', $FormContact->getEmail());
            $this->assertEquals('123 Rue de Paris', $FormContact->getAdresse());
            $this->assertEquals('Paris', $FormContact->getCity());
            $this->assertEquals('75001', $FormContact->getPostalCode());
            $this->assertEquals('Information request', $FormContact->getRequest());
            $this->assertEquals('Hello!', $FormContact->getMessage());
            $this->assertEquals(false, $FormContact->isIsArchived());
    }

    public function testNotValid(): void
    {
        $FormContact = new FormContact();

        $FormContact->setSex('false')
            ->setNickname('false')
            ->setLastname('false')
            ->setPhone('false')
            ->setEmail('false')
            ->setAdresse('false')
            ->setCity('false')
            ->setPostalCode('false')
            ->setRequest('false')
            ->setMessage('false')
            ->setIsArchived(true);

            $this->assertFalse($FormContact->getSex() === 'Monsieur');
            $this->assertFalse($FormContact->getNickname() === 'Nicolas');
            $this->assertFalse($FormContact->getLastname() === 'Dupont');
            $this->assertFalse($FormContact->getPhone() === '0332123456');
            $this->assertFalse($FormContact->getEmail() === 'nicolas@example.com');
            $this->assertFalse($FormContact->getAdresse() === '123 Rue de Paris');
            $this->assertFalse($FormContact->getCity() === 'Paris');
            $this->assertFalse($FormContact->getPostalCode() === '75001');
            $this->assertFalse($FormContact->getRequest() === 'Information request');
            $this->assertFalse($FormContact->getMessage() === 'Hello!');
            $this->assertFalse($FormContact->isIsArchived() === 'false');
    }

    public function testIsEmpty(): void
    {

        $FormContact = new FormContact();

            $this->assertEmpty($FormContact->getSex());
            $this->assertEmpty($FormContact->getNickname());
            $this->assertEmpty($FormContact->getLastname());
            $this->assertEmpty($FormContact->getPhone());
            $this->assertEmpty($FormContact->getEmail());
            $this->assertEmpty($FormContact->getAdresse());
            $this->assertEmpty($FormContact->getCity());
            $this->assertEmpty($FormContact->getPostalCode());
            $this->assertEmpty($FormContact->getRequest());
            $this->assertEmpty($FormContact->getMessage());
            $this->assertEmpty($FormContact->isIsArchived());
    }
}
