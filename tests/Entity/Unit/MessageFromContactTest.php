<?php

namespace App\Tests\Entity\Unit;

use App\Entity\MessageFromContact;
use PHPUnit\Framework\TestCase;

class MessageFromContactTest extends TestCase
{
    public function testIsValid(): void
    {

        $message = new MessageFromContact();

        $message->setSex('Mr')
            ->setNickname('Jean')
            ->setLastname('Charles')
            ->setPhone('0613975721')
            ->setEmail('charles.lem@gmail.com')
            ->setProfession('Développeur')
            ->setEtablissement('Mr Lemperiere Charles')
            ->setAdresse('47 route de bayeux')
            ->setPostalCode('14310')
            ->setCity('Villy-Bocage')
            ->setRequest('Test unitaire')
            ->setMessage('Mise en place de test unitaire');

        $this->assertTrue($message->getSex() === 'Mr');
        $this->assertTrue($message->getNickname() === 'Jean');
        $this->assertTrue($message->getLastname() === 'Charles');
        $this->assertTrue($message->getPhone() === '0613975721');
        $this->assertTrue($message->getEmail() === 'charles.lem@gmail.com');
        $this->assertTrue($message->getProfession() === 'Développeur');
        $this->assertTrue($message->getEtablissement() === 'Mr Lemperiere Charles');
        $this->assertTrue($message->getAdresse() === '47 route de bayeux');
        $this->assertTrue($message->getPostalCode() === '14310');
        $this->assertTrue($message->getCity() === 'Villy-Bocage');
        $this->assertTrue($message->getRequest() === 'Test unitaire');
        $this->assertTrue($message->getMessage() === 'Mise en place de test unitaire');
    }

    public function testNotValid(): void
    {
        $message = new MessageFromContact();

        $message->setSex('False')
            ->setNickname('False')
            ->setLastname('False')
            ->setPhone('False')
            ->setEmail('False')
            ->setProfession('False')
            ->setEtablissement('False')
            ->setAdresse('False')
            ->setPostalCode('False')
            ->setCity('False')
            ->setRequest('False')
            ->setMessage('False');

            $this->assertFalse($message->getSex() === 'Mr');
            $this->assertFalse($message->getNickname() === 'Jean');
            $this->assertFalse($message->getNickname() === 'Charles');
            $this->assertFalse($message->getPhone() === '0613975721');
            $this->assertFalse($message->getPhone() === 'charles.lem@gmail.com');
            $this->assertFalse($message->getProfession() === 'Développeur');
            $this->assertFalse($message->getEtablissement() === 'Mr Lemperiere Charles');
            $this->assertFalse($message->getAdresse() === '47 route de bayeux');
            $this->assertFalse($message->getPostalCode() === '14310');
            $this->assertFalse($message->getCity() === 'Villy-Bocage');
            $this->assertFalse($message->getRequest() === 'Test unitaire');
            $this->assertFalse($message->getMessage() === 'Mise en place de test unitaire');
    }

    public function testIsEmpty(): void
    {
        $message = new MessageFromContact();

            $this->assertEmpty($message->getSex());
            $this->assertEmpty($message->getNickname());
            $this->assertEmpty($message->getPhone());
            $this->assertEmpty($message->getProfession());
            $this->assertEmpty($message->getEtablissement());
            $this->assertEmpty($message->getAdresse());
            $this->assertEmpty($message->getPostalCode());
            $this->assertEmpty($message->getCity());
            $this->assertEmpty($message->getRequest());
            $this->assertEmpty($message->getMessage());
    }
}
