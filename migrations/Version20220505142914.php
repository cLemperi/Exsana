<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220505142914 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE objectif_formation (id INT AUTO_INCREMENT NOT NULL, objectifs_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_400F6A966DAD6F2 (objectifs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE programme_formation (id INT AUTO_INCREMENT NOT NULL, programmes_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_905A86B1A0A1C920 (programmes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE objectif_formation ADD CONSTRAINT FK_400F6A966DAD6F2 FOREIGN KEY (objectifs_id) REFERENCES formations (id)');
        $this->addSql('ALTER TABLE programme_formation ADD CONSTRAINT FK_905A86B1A0A1C920 FOREIGN KEY (programmes_id) REFERENCES formations (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE objectif_formation');
        $this->addSql('DROP TABLE programme_formation');
    }
}
