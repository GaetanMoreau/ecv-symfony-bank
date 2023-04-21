<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230421155901 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recharge (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, compte_id INTEGER DEFAULT NULL, montant DOUBLE PRECISION NOT NULL, recharge_date DATETIME NOT NULL, CONSTRAINT FK_B6702F51F2C56620 FOREIGN KEY (compte_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_B6702F51F2C56620 ON recharge (compte_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE recharge');
    }
}
