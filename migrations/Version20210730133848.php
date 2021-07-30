<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210730133848 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formations CHANGE date_add created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE formations ADD CONSTRAINT FK_4090213712469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_4090213712469DE2 ON formations (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formations DROP FOREIGN KEY FK_4090213712469DE2');
        $this->addSql('DROP INDEX IDX_4090213712469DE2 ON formations');
        $this->addSql('ALTER TABLE formations CHANGE created_at date_add DATETIME NOT NULL');
    }
}
