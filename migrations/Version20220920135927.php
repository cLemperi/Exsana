<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220920135927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_message DROP FOREIGN KEY FK_EEB02E75C97DFC75');
        $this->addSql('DROP INDEX IDX_EEB02E75C97DFC75 ON user_message');
        $this->addSql('ALTER TABLE user_message CHANGE user_messafe_id user_message_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_message ADD CONSTRAINT FK_EEB02E75F41DD5C5 FOREIGN KEY (user_message_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_EEB02E75F41DD5C5 ON user_message (user_message_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_message DROP FOREIGN KEY FK_EEB02E75F41DD5C5');
        $this->addSql('DROP INDEX IDX_EEB02E75F41DD5C5 ON user_message');
        $this->addSql('ALTER TABLE user_message CHANGE user_message_id user_messafe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_message ADD CONSTRAINT FK_EEB02E75C97DFC75 FOREIGN KEY (user_messafe_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_EEB02E75C97DFC75 ON user_message (user_messafe_id)');
    }
}
