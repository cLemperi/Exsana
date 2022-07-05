<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220704141441 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD sex VARCHAR(255) NOT NULL, ADD first_name VARCHAR(255) NOT NULL, ADD last_name VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD job VARCHAR(255) NOT NULL, ADD phone VARCHAR(255) DEFAULT NULL, ADD rpps_code VARCHAR(255) DEFAULT NULL, ADD postal_code VARCHAR(255) DEFAULT NULL, ADD city VARCHAR(255) DEFAULT NULL, ADD profil VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP sex, DROP first_name, DROP last_name, DROP email, DROP job, DROP phone, DROP rpps_code, DROP postal_code, DROP city, DROP profil');
    }
}
