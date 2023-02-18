<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230217211956 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matches DROP FOREIGN KEY FK_62615BA79F1065D');
        $this->addSql('DROP INDEX IDX_62615BA79F1065D ON matches');
        $this->addSql('ALTER TABLE matches DROP list_joueurs_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matches ADD list_joueurs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE matches ADD CONSTRAINT FK_62615BA79F1065D FOREIGN KEY (list_joueurs_id) REFERENCES equipe (id)');
        $this->addSql('CREATE INDEX IDX_62615BA79F1065D ON matches (list_joueurs_id)');
    }
}
