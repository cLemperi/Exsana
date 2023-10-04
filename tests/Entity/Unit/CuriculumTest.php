<?php

namespace App\Tests\Entity\Unit;

use App\Entity\Curiculum;
use PHPUnit\Framework\TestCase;

class CuriculumTest extends TestCase
{
    public function testIsValid(): void
    {

        $curiculum = new Curiculum();

        $curiculum->setTitre('Test Title');
        $curiculum->setCuriculumFile('filename.pdf');
        $curiculum->setFirstname('John');
        $curiculum->setLastname('Doe');
        $curiculum->setMessage('Test curiculum');

        $this->assertTrue($curiculum->getTitre() === 'Test Title');
        $this->assertTrue($curiculum->getCuriculumFile() === 'filename.pdf');
        $this->assertTrue($curiculum->getFirstname() === 'John');
        $this->assertTrue($curiculum->getLastname() === 'Doe');
        $this->assertTrue($curiculum->getMessage() === 'Test curiculum');

    }

    public function testNotValid(): void
    {
        $curiculum = new Curiculum();

        $curiculum->setTitre('Fasle');
        $curiculum->setCuriculumFile('Fasle');
        $curiculum->setFirstname('Fasle');
        $curiculum->setLastname('Fasle');
        $curiculum->setMessage('Fasle');

            $this->assertFalse($curiculum->getTitre() === 'Test Title');
            $this->assertFalse($curiculum->getCuriculumFile() === 'filename.pdf');
            $this->assertFalse($curiculum->getFirstname() === 'John');
            $this->assertFalse($curiculum->getLastname() === 'Doe');
            $this->assertFalse($curiculum->getMessage() === 'Test curiculum');
    }

    public function testIsEmpty(): void {
        $curiculum = new Curiculum();

            $this->assertEmpty($curiculum->getTitre());
            $this->assertEmpty($curiculum->getCuriculumFile());
            $this->assertEmpty($curiculum->getFirstname());
            $this->assertEmpty($curiculum->getLastname());
            $this->assertEmpty($curiculum->getMessage());
    }
}
