<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241019123314 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE video (id SERIAL NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, thumbnail VARCHAR(255) DEFAULT NULL, url VARCHAR(255) NOT NULL, duration VARCHAR(255) DEFAULT NULL, active BOOLEAN NOT NULL, released_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN video.released_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE video');
    }
}
