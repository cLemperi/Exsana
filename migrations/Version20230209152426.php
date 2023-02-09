<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230209152426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formations CHANGE evaluation evaluation LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE objectif_formation CHANGE name name LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE programme_formation CHANGE name name LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formations CHANGE evaluation evaluation VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE objectif_formation CHANGE name name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE programme_formation CHANGE name name VARCHAR(255) DEFAULT NULL');
    }
}
