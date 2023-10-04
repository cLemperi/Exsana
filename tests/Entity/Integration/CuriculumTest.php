<?php

namespace App\Tests\Entity\Integration;

use App\Entity\Curiculum;
use Symfony\Component\Validator\Validation;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CuriculumTest extends KernelTestCase
{
    private $validator;

    protected function setUp(): void
    {
        $this->validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();
    }

    public function testValidCuriculum()
    {
        $curiculum = new Curiculum();
        $curiculum->setTitre('Test Title');
        $curiculum->setCuriculumFile('filename.pdf');
        $curiculum->setFirstname('John');
        $curiculum->setLastname('Doe');
        $curiculum->setMessage('Test message');

        $errors = $this->validator->validate($curiculum);
        $this->assertCount(0, $errors);
    }

    public function testInvalidFirstName()
    {
        $curiculum = new Curiculum();
        $curiculum->setFirstname('John123');

        $errors = $this->validator->validateProperty($curiculum, 'Firstname');
        $this->assertGreaterThan(0, count($errors));
    }

    public function testInvalidLastName()
    {
        $curiculum = new Curiculum();
        $curiculum->setLastname('Doe@123');

        $errors = $this->validator->validateProperty($curiculum, 'lastname');
        $this->assertGreaterThan(0, count($errors));
    }

    public function testGetterAndSetter()
    {
        $curiculum = new Curiculum();
        $curiculum->setTitre('Test Title');
        $curiculum->setCuriculumFile('filename.pdf');
        $curiculum->setFirstname('John');
        $curiculum->setLastname('Doe');
        $curiculum->setMessage('Test message');
        $date = new \DateTime();

        $curiculum->setCreatedAt($date);

        $this->assertEquals('Test Title', $curiculum->getTitre());
        $this->assertEquals('filename.pdf', $curiculum->getCuriculumFile());
        $this->assertEquals('John', $curiculum->getFirstname());
        $this->assertEquals('Doe', $curiculum->getLastname());
        $this->assertEquals('Test message', $curiculum->getMessage());
        $this->assertEquals($date, $curiculum->getCreatedAt());
    }

    public function testNotValidData(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $validator = $container->get('validator');
        $curiculum = new Curiculum();

        $curiculum->setTitre('T1') // Titre trop court
            ->setCuriculumFile('a' . str_repeat('a', 255) . '.pdf') // Nom de fichier trop long
            ->setFirstname('John123') // Prénom contenant des chiffres
            ->setLastname('Doe@123') // Nom contenant des caractères spéciaux
            ->setMessage(str_repeat('a', 3100)); // Message trop long

        $errors = $validator->validate($curiculum);

        $this->assertGreaterThan(0, count($errors), "Il devrait y avoir des erreurs de validation");

        $expectedErrors = [
            'Le titre doit contenir au moins 2 caractères.',
            'Le nom du fichier CV ne peut pas contenir plus de 255 caractères.',
            'Le prénom ne peut contenir que des lettres, des espaces et des tirets.',
            'Le nom ne peut contenir que des lettres, des espaces et des tirets.',
            'Le message ne peut pas contenir plus de 3000 caractères.',
            'L\'email ne peut pas contenir plus de {{ limit }} caractères'
        ];

        foreach ($errors as $error) {
            $this->assertContains($error->getMessage(), $expectedErrors);
        }
    }
}
