<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260223173059 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job ADD COLUMN priority INTEGER NOT NULL');
        $this->addSql('ALTER TABLE job ADD COLUMN difficulty INTEGER NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__job AS SELECT id, description, quantity, daily_rate, quote_id FROM job');
        $this->addSql('DROP TABLE job');
        $this->addSql('CREATE TABLE job (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, description VARCHAR(255) NOT NULL, quantity INTEGER NOT NULL, daily_rate DOUBLE PRECISION NOT NULL, quote_id INTEGER NOT NULL, CONSTRAINT FK_FBD8E0F8DB805178 FOREIGN KEY (quote_id) REFERENCES quote (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO job (id, description, quantity, daily_rate, quote_id) SELECT id, description, quantity, daily_rate, quote_id FROM __temp__job');
        $this->addSql('DROP TABLE __temp__job');
        $this->addSql('CREATE INDEX IDX_FBD8E0F8DB805178 ON job (quote_id)');
    }
}
