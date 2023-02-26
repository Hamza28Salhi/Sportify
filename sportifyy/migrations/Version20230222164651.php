<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222164651 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE matr_fisc matr_fisc VARCHAR(255) DEFAULT NULL, CHANGE prod_category prod_category VARCHAR(255) DEFAULT NULL, CHANGE job_position job_position VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE matr_fisc matr_fisc VARCHAR(255) NOT NULL, CHANGE prod_category prod_category VARCHAR(255) NOT NULL, CHANGE job_position job_position VARCHAR(255) NOT NULL');
    }
}
