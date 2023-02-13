<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230213000108 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matches ADD nom_equipe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE matches ADD CONSTRAINT FK_62615BAF9776AC8 FOREIGN KEY (nom_equipe_id) REFERENCES equipe (id)');
        $this->addSql('CREATE INDEX IDX_62615BAF9776AC8 ON matches (nom_equipe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matches DROP FOREIGN KEY FK_62615BAF9776AC8');
        $this->addSql('DROP INDEX IDX_62615BAF9776AC8 ON matches');
        $this->addSql('ALTER TABLE matches DROP nom_equipe_id');
    }
}
