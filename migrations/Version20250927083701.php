<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250927083701 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE stream (id INT AUTO_INCREMENT NOT NULL, source VARCHAR(100) DEFAULT NULL, source_comment VARCHAR(100) DEFAULT NULL, stream_comment VARCHAR(100) DEFAULT NULL, last_conv_at DATE NOT NULL, revenue INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offer ADD stream_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873ED0ED463E FOREIGN KEY (stream_id) REFERENCES stream (id)');
        $this->addSql('CREATE INDEX IDX_29D6873ED0ED463E ON offer (stream_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873ED0ED463E');
        $this->addSql('DROP TABLE stream');
        $this->addSql('DROP INDEX IDX_29D6873ED0ED463E ON offer');
        $this->addSql('ALTER TABLE offer DROP stream_id');
    }
}
