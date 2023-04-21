<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230421162350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__recharge AS SELECT id, compte_id, montant, recharge_date, carte FROM recharge');
        $this->addSql('DROP TABLE recharge');
        $this->addSql('CREATE TABLE recharge (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, compte_id INTEGER DEFAULT NULL, montant DOUBLE PRECISION NOT NULL, recharge_date DATETIME NOT NULL, carte VARCHAR(255) NOT NULL, CONSTRAINT FK_B6702F51F2C56620 FOREIGN KEY (compte_id) REFERENCES account (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO recharge (id, compte_id, montant, recharge_date, carte) SELECT id, compte_id, montant, recharge_date, carte FROM __temp__recharge');
        $this->addSql('DROP TABLE __temp__recharge');
        $this->addSql('CREATE INDEX IDX_B6702F51F2C56620 ON recharge (compte_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__recharge AS SELECT id, compte_id, montant, recharge_date, carte FROM recharge');
        $this->addSql('DROP TABLE recharge');
        $this->addSql('CREATE TABLE recharge (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, compte_id INTEGER DEFAULT NULL, montant DOUBLE PRECISION NOT NULL, recharge_date DATETIME NOT NULL, carte INTEGER NOT NULL, CONSTRAINT FK_B6702F51F2C56620 FOREIGN KEY (compte_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO recharge (id, compte_id, montant, recharge_date, carte) SELECT id, compte_id, montant, recharge_date, carte FROM __temp__recharge');
        $this->addSql('DROP TABLE __temp__recharge');
        $this->addSql('CREATE INDEX IDX_B6702F51F2C56620 ON recharge (compte_id)');
    }
}
