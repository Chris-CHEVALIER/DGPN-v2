<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230703094308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event ADD start_date DATETIME NOT NULL, ADD end_date DATETIME NOT NULL, DROP begin, DROP end, DROP unite, DROP ticket');
        $this->addSql('ALTER TABLE ticket ADD event_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA371F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_97A0ADA371F7E88B ON ticket (event_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event ADD begin DATETIME NOT NULL, ADD end DATETIME NOT NULL, ADD unite LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', ADD ticket VARCHAR(255) DEFAULT NULL, DROP start_date, DROP end_date');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA371F7E88B');
        $this->addSql('DROP INDEX UNIQ_97A0ADA371F7E88B ON ticket');
        $this->addSql('ALTER TABLE ticket DROP event_id');
    }
}
