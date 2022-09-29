<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220829121238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formations ADD user_register_formation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formations ADD CONSTRAINT FK_409021373613F869 FOREIGN KEY (user_register_formation_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_409021373613F869 ON formations (user_register_formation_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64937E6E999');
        $this->addSql('DROP INDEX IDX_8D93D64937E6E999 ON user');
        $this->addSql('ALTER TABLE user DROP message_user_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formations DROP FOREIGN KEY FK_409021373613F869');
        $this->addSql('DROP INDEX IDX_409021373613F869 ON formations');
        $this->addSql('ALTER TABLE formations DROP user_register_formation_id');
        $this->addSql('ALTER TABLE user ADD message_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64937E6E999 FOREIGN KEY (message_user_id) REFERENCES user_message (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64937E6E999 ON user (message_user_id)');
    }
}
