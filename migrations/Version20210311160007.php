<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210311160007 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formations ADD objectif_formation LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', ADD programme_formmation LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', ADD for_who VARCHAR(255) DEFAULT NULL, ADD prerequisite VARCHAR(255) DEFAULT NULL, ADD date_add DATETIME NOT NULL, ADD date_formation DATETIME DEFAULT NULL, ADD duration_formation INT DEFAULT NULL, CHANGE content location VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formations DROP objectif_formation, DROP programme_formmation, DROP for_who, DROP prerequisite, DROP date_add, DROP date_formation, DROP duration_formation, CHANGE location content VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
