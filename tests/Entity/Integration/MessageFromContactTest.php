<?php

namespace App\Tests\Entity\Integration;

use App\Entity\MessageFromContact;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MessageFromContactTest extends KernelTestCase
{
    public function testValidData(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $validator = $container->get('validator');

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

        $errors = $validator->validate($message);
        $this->assertCount(0, $errors, "Il y a une ou plusieurs erreurs de validation.");
    }

    public function testNotValidData(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $validator = $container->get('validator');
        $message = new MessageFromContact();

        $message->setSex('Madameee')
            ->setNickname('test33')
            ->setLastname('test33')
            ->setPhone('0332')
            ->setEmail('test')
            ->setProfession('test33')
            ->setEtablissement('test33')
            ->setAdresse('test33')
            ->setPostalCode('14')
            ->setCity('test33')
            ->setRequest(12)
            ->setMessage(12);

        $errors = $validator->validate($message);

        $this->assertGreaterThan(0, count($errors), "Il devrait y avoir des erreurs de validation");

        $expectedErrors = [
            'Veuillez choisir un sexe valide.',
            'Le surnom ne doit contenir que des lettres, des espaces, des apostrophes ou des tirets.',
            'Le nom ne doit contenir que des lettres, des espaces, des apostrophes ou des tirets.',
            'Le format du numéro de téléphone n\'est pas valide.',
            'Le format de l\'email n\'est pas valide.',
            'L\'email ne peut pas contenir plus de {{ limit }} caractères.',
            'Le code postal doit être composé de 4 à 5 chiffres.',
            'This value should not be blank'
        ];

        foreach ($errors as $error) {
            $this->assertContains($error->getMessage(), $expectedErrors);
        }
    }
}
