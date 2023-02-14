<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230213164027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formations DROP FOREIGN KEY FK_409021373613F869');
        $this->addSql('DROP INDEX IDX_409021373613F869 ON formations');
        $this->addSql('ALTER TABLE formations DROP user_register_formation_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formations ADD user_register_formation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formations ADD CONSTRAINT FK_409021373613F869 FOREIGN KEY (user_register_formation_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_409021373613F869 ON formations (user_register_formation_id)');
    }
}
