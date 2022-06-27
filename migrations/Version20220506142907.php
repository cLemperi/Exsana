<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220506142907 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formations CHANGE location location VARCHAR(255) DEFAULT NULL, CHANGE price price INT DEFAULT 0 NOT NULL, CHANGE duration duration INT DEFAULT 0 NOT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formations CHANGE price price INT NOT NULL, CHANGE duration duration INT NOT NULL, CHANGE created_at created_at DATETIME NOT NULL, CHANGE location location VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
