<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220808103213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE objectif_formation DROP FOREIGN KEY FK_400F6A9BF396750');
        $this->addSql('ALTER TABLE objectif_formation ADD objForma_id INT NOT NULL');
        $this->addSql('ALTER TABLE objectif_formation ADD CONSTRAINT FK_400F6A91B2A6871 FOREIGN KEY (objForma_id) REFERENCES formations (id)');
        $this->addSql('CREATE INDEX IDX_400F6A91B2A6871 ON objectif_formation (objForma_id)');
        $this->addSql('ALTER TABLE programme_formation DROP FOREIGN KEY FK_905A86B162BB7AEE');
        $this->addSql('DROP INDEX IDX_905A86B162BB7AEE ON programme_formation');
        $this->addSql('ALTER TABLE programme_formation CHANGE programme_id proForma_id INT NOT NULL');
        $this->addSql('ALTER TABLE programme_formation ADD CONSTRAINT FK_905A86B14B1D9CDB FOREIGN KEY (proForma_id) REFERENCES formations (id)');
        $this->addSql('CREATE INDEX IDX_905A86B14B1D9CDB ON programme_formation (proForma_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE objectif_formation DROP FOREIGN KEY FK_400F6A91B2A6871');
        $this->addSql('DROP INDEX IDX_400F6A91B2A6871 ON objectif_formation');
        $this->addSql('ALTER TABLE objectif_formation DROP objForma_id');
        $this->addSql('ALTER TABLE objectif_formation ADD CONSTRAINT FK_400F6A9BF396750 FOREIGN KEY (id) REFERENCES formations (id)');
        $this->addSql('ALTER TABLE programme_formation DROP FOREIGN KEY FK_905A86B14B1D9CDB');
        $this->addSql('DROP INDEX IDX_905A86B14B1D9CDB ON programme_formation');
        $this->addSql('ALTER TABLE programme_formation CHANGE proForma_id programme_id INT NOT NULL');
        $this->addSql('ALTER TABLE programme_formation ADD CONSTRAINT FK_905A86B162BB7AEE FOREIGN KEY (programme_id) REFERENCES formations (id)');
        $this->addSql('CREATE INDEX IDX_905A86B162BB7AEE ON programme_formation (programme_id)');
    }
}
