<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230207150201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE curiculum (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, curiculum_file VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, message LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE form_contact (id INT AUTO_INCREMENT NOT NULL, sex VARCHAR(255) NOT NULL, nickname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, profession VARCHAR(255) NOT NULL, etablissement VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, request VARCHAR(255) NOT NULL, message LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formations (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, user_register_formation_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, price VARCHAR(255) DEFAULT NULL, duration INT DEFAULT 0 NOT NULL, for_who VARCHAR(255) DEFAULT NULL, prerequisite VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, date_formation DATETIME DEFAULT NULL, duration_formation INT DEFAULT NULL, location VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, intervenant VARCHAR(255) DEFAULT NULL, evaluation VARCHAR(255) DEFAULT NULL, public_and_access_condition LONGTEXT DEFAULT NULL, INDEX IDX_4090213712469DE2 (category_id), INDEX IDX_409021373613F869 (user_register_formation_id), FULLTEXT INDEX IDX_409021372B36786B (title), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message_from_contact (id INT AUTO_INCREMENT NOT NULL, sex VARCHAR(255) NOT NULL, nickname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, profession VARCHAR(255) DEFAULT NULL, etablissement VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, request VARCHAR(255) DEFAULT NULL, message LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE objectif_formation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, title VARCHAR(255) NOT NULL, objForma_id INT NOT NULL, INDEX IDX_400F6A91B2A6871 (objForma_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE programme_formation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, title VARCHAR(255) NOT NULL, proForma_id INT NOT NULL, INDEX IDX_905A86B14B1D9CDB (proForma_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, sex VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, job VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, rpps_code VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, profil VARCHAR(255) NOT NULL, nb_user_invite INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_invite (id INT AUTO_INCREMENT NOT NULL, user_from_id INT NOT NULL, nickname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, profession VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_A2B00BEA20C3C701 (user_from_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_invite_formations (user_invite_id INT NOT NULL, formations_id INT NOT NULL, INDEX IDX_BEADF1F7EAA1FAA3 (user_invite_id), INDEX IDX_BEADF1F73BF5B0C2 (formations_id), PRIMARY KEY(user_invite_id, formations_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_message (id INT AUTO_INCREMENT NOT NULL, user_message_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, INDEX IDX_EEB02E75F41DD5C5 (user_message_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE formations ADD CONSTRAINT FK_4090213712469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE formations ADD CONSTRAINT FK_409021373613F869 FOREIGN KEY (user_register_formation_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE objectif_formation ADD CONSTRAINT FK_400F6A91B2A6871 FOREIGN KEY (objForma_id) REFERENCES formations (id)');
        $this->addSql('ALTER TABLE programme_formation ADD CONSTRAINT FK_905A86B14B1D9CDB FOREIGN KEY (proForma_id) REFERENCES formations (id)');
        $this->addSql('ALTER TABLE user_invite ADD CONSTRAINT FK_A2B00BEA20C3C701 FOREIGN KEY (user_from_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_invite_formations ADD CONSTRAINT FK_BEADF1F7EAA1FAA3 FOREIGN KEY (user_invite_id) REFERENCES user_invite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_invite_formations ADD CONSTRAINT FK_BEADF1F73BF5B0C2 FOREIGN KEY (formations_id) REFERENCES formations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_message ADD CONSTRAINT FK_EEB02E75F41DD5C5 FOREIGN KEY (user_message_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formations DROP FOREIGN KEY FK_4090213712469DE2');
        $this->addSql('ALTER TABLE objectif_formation DROP FOREIGN KEY FK_400F6A91B2A6871');
        $this->addSql('ALTER TABLE programme_formation DROP FOREIGN KEY FK_905A86B14B1D9CDB');
        $this->addSql('ALTER TABLE user_invite_formations DROP FOREIGN KEY FK_BEADF1F73BF5B0C2');
        $this->addSql('ALTER TABLE formations DROP FOREIGN KEY FK_409021373613F869');
        $this->addSql('ALTER TABLE user_invite DROP FOREIGN KEY FK_A2B00BEA20C3C701');
        $this->addSql('ALTER TABLE user_message DROP FOREIGN KEY FK_EEB02E75F41DD5C5');
        $this->addSql('ALTER TABLE user_invite_formations DROP FOREIGN KEY FK_BEADF1F7EAA1FAA3');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE curiculum');
        $this->addSql('DROP TABLE form_contact');
        $this->addSql('DROP TABLE formations');
        $this->addSql('DROP TABLE message_from_contact');
        $this->addSql('DROP TABLE objectif_formation');
        $this->addSql('DROP TABLE programme_formation');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_invite');
        $this->addSql('DROP TABLE user_invite_formations');
        $this->addSql('DROP TABLE user_message');
    }
}
