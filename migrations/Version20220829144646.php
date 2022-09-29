<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220829144646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_invite (id INT AUTO_INCREMENT NOT NULL, user_from_id INT NOT NULL, nickname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, profession VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_A2B00BEA20C3C701 (user_from_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_invite_formations (user_invite_id INT NOT NULL, formations_id INT NOT NULL, INDEX IDX_BEADF1F7EAA1FAA3 (user_invite_id), INDEX IDX_BEADF1F73BF5B0C2 (formations_id), PRIMARY KEY(user_invite_id, formations_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_invite ADD CONSTRAINT FK_A2B00BEA20C3C701 FOREIGN KEY (user_from_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_invite_formations ADD CONSTRAINT FK_BEADF1F7EAA1FAA3 FOREIGN KEY (user_invite_id) REFERENCES user_invite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_invite_formations ADD CONSTRAINT FK_BEADF1F73BF5B0C2 FOREIGN KEY (formations_id) REFERENCES formations (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_invite_formations DROP FOREIGN KEY FK_BEADF1F7EAA1FAA3');
        $this->addSql('DROP TABLE user_invite');
        $this->addSql('DROP TABLE user_invite_formations');
    }
}
