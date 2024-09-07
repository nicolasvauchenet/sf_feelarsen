<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240907133744 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE date_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE date (id INT NOT NULL, calendar_id INT NOT NULL, location VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, poster VARCHAR(255) DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, start_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AA9E377AA40A2C8 ON date (calendar_id)');
        $this->addSql('COMMENT ON COLUMN date.start_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE date ADD CONSTRAINT FK_AA9E377AA40A2C8 FOREIGN KEY (calendar_id) REFERENCES calendar (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE date_id_seq CASCADE');
        $this->addSql('ALTER TABLE date DROP CONSTRAINT FK_AA9E377AA40A2C8');
        $this->addSql('DROP TABLE date');
    }
}
