<?php

namespace App\Tests\Entity\Integration;

use App\Entity\FormContact;
use Egulias\EmailValidator\EmailValidator;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintValidatorFactory;

class FormContactTest extends KernelTestCase
{
    private $validator;

    protected function setUp(): void
    {
        $this->validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->setConstraintValidatorFactory(
                new ConstraintValidatorFactory([EmailValidator::class => new EmailValidator(
                    Email::VALIDATION_MODE_HTML5
                )])
            )
            ->getValidator();
    }

    public function testValidFormContact()
    {
        $contactForm = new FormContact();
        $contactForm->setSex('Monsieur')
            ->setNickname('Nicolas')
            ->setLastname('Dupont')
            ->setPhone('0332123456')
            ->setEmail('nicolas@example.com')
            ->setAdresse('123 Rue de Paris')
            ->setCity('Paris')
            ->setPostalCode('75001')
            ->setRequest('Information request')
            ->setIsArchived(false);

        $errors = $this->validator->validate($contactForm);
        $this->assertCount(0, $errors);
    }

    public function testInvalidNickname()
    {
        $contactForm = new FormContact();
        $contactForm->setNickname('Nick123');

        $errors = $this->validator->validateProperty($contactForm, 'nickname');
        $this->assertGreaterThan(0, count($errors));
    }

    public function testInvalidLastName()
    {
        $contactForm = new FormContact();
        $contactForm->setLastname('Lastname123');

        $errors = $this->validator->validateProperty($contactForm, 'lastname');
        $this->assertGreaterThan(0, count($errors));
    }

    public function testInvalidEmail()
    {
        $contactForm = new FormContact();
        $contactForm->setEmail('email-test');

        $errors = $this->validator->validateProperty($contactForm, 'email');
        $this->assertGreaterThan(0, count($errors));
    }

    public function testGetterAndSetter()
    {
        $contactForm = new FormContact();
        $contactForm->setSex('Monsieur')
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

        $this->assertEquals('Monsieur', $contactForm->getSex());
        $this->assertEquals('Nicolas', $contactForm->getNickname());
        $this->assertEquals('Dupont', $contactForm->getLastname());
        $this->assertEquals('0332123456', $contactForm->getPhone());
        $this->assertEquals('nicolas@example.com', $contactForm->getEmail());
        $this->assertEquals('123 Rue de Paris', $contactForm->getAdresse());
        $this->assertEquals('Paris', $contactForm->getCity());
        $this->assertEquals('75001', $contactForm->getPostalCode());
        $this->assertEquals('Information request', $contactForm->getRequest());
        $this->assertEquals('Hello!', $contactForm->getMessage());
        $this->assertEquals(false, $contactForm->isIsArchived());
        // ... Continue for the other properties
    }

    public function testNotValidData(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $validator = $container->get('validator');
        $contactForm = new FormContact();

        $contactForm
            ->setSex('Monsieur12')
            ->setNickname('Nick123') // Nickname avec des chiffres
            ->setLastname('Last123') // Lastname avec des chiffres
            ->setPhone('0332') // Numéro de téléphone incorrect
            ->setEmail('test12') // Email non valide
            ->setAdresse(str_repeat('a', 110)) // Adresse trop longue
            ->setCity(str_repeat('a', 60)) // City trop longue
            ->setPostalCode('14') // Code postal non conforme
            ->setRequest('') // NotBlank donc nécessaire, mais rien n'empêche une chaîne vide
            ->setMessage(12)
            ->setIsArchived(12);

        $errors = $validator->validate($contactForm);

        $this->assertGreaterThan(0, count($errors), "Il devrait y avoir des erreurs de validation");

        $expectedErrors = [
            'Your name cannot contain a number', // Pour le nickname et lastname
            'Veuillez entrer un numéro de téléphone portable ou fixe français valide.', // Pour le téléphone
            'L\'email ne peut pas être vide.',
            'Le format de l\'email n\'est pas valide.',
            'This value is not valid.', // Pour l'email
            'This value is too long. It should have 100 characters or less.', // Pour l'adresse
            'This value is too long. It should have 50 characters or less.', // Pour la city
            'This value should match the expected pattern.', // Pour le code postal
            'This value should not be blank.'
        ];

        foreach ($errors as $error) {
            echo $error->getMessage() . "\n";
            $this->assertContains($error->getMessage(), $expectedErrors);
        }
    }
}
