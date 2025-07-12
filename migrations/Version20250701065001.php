<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250701065001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE offer (id INT AUTO_INCREMENT NOT NULL, advertiser_id INT DEFAULT NULL, affise_advertiser_id VARCHAR(100) NOT NULL, affise_offer_id VARCHAR(100) NOT NULL, title VARCHAR(100) NOT NULL, status VARCHAR(100) NOT NULL, privacy VARCHAR(100) NOT NULL, geo VARCHAR(100) NOT NULL, INDEX IDX_29D6873EBA2FCBC2 (advertiser_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873EBA2FCBC2 FOREIGN KEY (advertiser_id) REFERENCES advertiser (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873EBA2FCBC2');
        $this->addSql('DROP TABLE offer');
    }
}
