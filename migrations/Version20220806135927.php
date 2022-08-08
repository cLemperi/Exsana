<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220806135927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE objectif_formation DROP FOREIGN KEY FK_400F6A966DAD6F2');
        $this->addSql('ALTER TABLE objectif_formation ADD CONSTRAINT FK_400F6A966DAD6F266DAD6F2 FOREIGN KEY (objectifs_id) REFERENCES formations (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE objectif_formation DROP FOREIGN KEY FK_400F6A966DAD6F266DAD6F2');
        $this->addSql('ALTER TABLE objectif_formation ADD CONSTRAINT FK_400F6A966DAD6F2 FOREIGN KEY (objectifs_id) REFERENCES formations (id)');
    }
}
