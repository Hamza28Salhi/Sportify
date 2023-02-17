<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230217031011 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe ADD picture VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE matches CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE adversaire adversaire VARCHAR(255) NOT NULL, CHANGE stade stade VARCHAR(255) NOT NULL, CHANGE date date DATETIME NOT NULL, CHANGE list_joueurs list_joueurs VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe DROP picture');
        $this->addSql('ALTER TABLE matches CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE adversaire adversaire VARCHAR(255) DEFAULT NULL, CHANGE stade stade VARCHAR(255) DEFAULT NULL, CHANGE date date DATETIME DEFAULT NULL, CHANGE list_joueurs list_joueurs VARCHAR(255) DEFAULT NULL');
    }
}
