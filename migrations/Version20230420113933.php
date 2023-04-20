<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230420113933 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "transaction" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, compte_origine_id INTEGER DEFAULT NULL, compte_destination_id INTEGER DEFAULT NULL, montant DOUBLE PRECISION NOT NULL, description VARCHAR(255) NOT NULL, transaction_date DATETIME NOT NULL, CONSTRAINT FK_723705D1C8934630 FOREIGN KEY (compte_origine_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_723705D14105B733 FOREIGN KEY (compte_destination_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_723705D1C8934630 ON "transaction" (compte_origine_id)');
        $this->addSql('CREATE INDEX IDX_723705D14105B733 ON "transaction" (compte_destination_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE "transaction"');
    }
}
