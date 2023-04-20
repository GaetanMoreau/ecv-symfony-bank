<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230420114047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__account AS SELECT id, solde, status FROM account');
        $this->addSql('DROP TABLE account');
        $this->addSql('CREATE TABLE account (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, proprietaire_id INTEGER DEFAULT NULL, solde DOUBLE PRECISION NOT NULL, status BOOLEAN NOT NULL, CONSTRAINT FK_7D3656A476C50E4A FOREIGN KEY (proprietaire_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO account (id, solde, status) SELECT id, solde, status FROM __temp__account');
        $this->addSql('DROP TABLE __temp__account');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D3656A476C50E4A ON account (proprietaire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__account AS SELECT id, solde, status FROM account');
        $this->addSql('DROP TABLE account');
        $this->addSql('CREATE TABLE account (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, solde DOUBLE PRECISION NOT NULL, status BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO account (id, solde, status) SELECT id, solde, status FROM __temp__account');
        $this->addSql('DROP TABLE __temp__account');
    }
}
