<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251013174227 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stream CHANGE source source VARCHAR(255) DEFAULT NULL, CHANGE last_conv_at last_conv_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE revenue revenue INT DEFAULT NULL, CHANGE start_at start_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stream CHANGE source source VARCHAR(100) DEFAULT NULL, CHANGE start_at start_at DATETIME DEFAULT NULL, CHANGE last_conv_at last_conv_at DATE NOT NULL, CHANGE revenue revenue INT NOT NULL');
    }
}
