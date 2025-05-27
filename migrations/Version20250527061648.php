<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250527061648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_93312772BD16857 ON advertiser');
        $this->addSql('DROP INDEX UNIQ_93312772D20E164E ON advertiser');
        $this->addSql('ALTER TABLE advertiser DROP created_at, DROP updated_at');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE advertiser ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_93312772BD16857 ON advertiser (affise_advertiser_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_93312772D20E164E ON advertiser (affise_manager_id)');
    }
}
