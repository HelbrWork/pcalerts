<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251106075015 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cap (id INT AUTO_INCREMENT NOT NULL, partner_id INT NOT NULL, offer_id INT NOT NULL, conversion_id VARCHAR(100) DEFAULT NULL, geo VARCHAR(100) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_993387B19393F8FE (partner_id), INDEX IDX_993387B153C674EE (offer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cap ADD CONSTRAINT FK_993387B19393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id)');
        $this->addSql('ALTER TABLE cap ADD CONSTRAINT FK_993387B153C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE partner ADD email VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cap DROP FOREIGN KEY FK_993387B19393F8FE');
        $this->addSql('ALTER TABLE cap DROP FOREIGN KEY FK_993387B153C674EE');
        $this->addSql('DROP TABLE cap');
        $this->addSql('ALTER TABLE partner DROP email');
    }
}
