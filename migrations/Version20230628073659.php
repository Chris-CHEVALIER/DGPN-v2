<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230628073659 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, begin DATETIME NOT NULL, end DATETIME NOT NULL, unite LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', ticket VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unit (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, unit_tyoe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone_number VARCHAR(255) DEFAULT NULL, user_group VARCHAR(255) DEFAULT NULL, user_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ticket ADD created_at DATETIME NOT NULL, ADD last_update DATETIME NOT NULL, ADD unit_requested INT NOT NULL, DROP asked_date, DROP ufm_asked, CHANGE status status VARCHAR(255) NOT NULL, CHANGE postal_code postal_code INT NOT NULL, CHANGE context description LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE unit');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE ticket ADD asked_date DATE NOT NULL, ADD ufm_asked DOUBLE PRECISION NOT NULL, DROP created_at, DROP last_update, DROP unit_requested, CHANGE status status VARCHAR(32) NOT NULL, CHANGE postal_code postal_code VARCHAR(8) NOT NULL, CHANGE description context LONGTEXT DEFAULT NULL');
    }
}
