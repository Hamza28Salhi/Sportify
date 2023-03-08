<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308000630 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vote ADD user_id_id INT DEFAULT NULL, ADD post_id_id INT DEFAULT NULL, ADD type_vote VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A1085649D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A108564E85F12B8 FOREIGN KEY (post_id_id) REFERENCES post (id)');
        $this->addSql('CREATE INDEX IDX_5A1085649D86650F ON vote (user_id_id)');
        $this->addSql('CREATE INDEX IDX_5A108564E85F12B8 ON vote (post_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vote DROP FOREIGN KEY FK_5A1085649D86650F');
        $this->addSql('ALTER TABLE vote DROP FOREIGN KEY FK_5A108564E85F12B8');
        $this->addSql('DROP INDEX IDX_5A1085649D86650F ON vote');
        $this->addSql('DROP INDEX IDX_5A108564E85F12B8 ON vote');
        $this->addSql('ALTER TABLE vote DROP user_id_id, DROP post_id_id, DROP type_vote');
    }
}
