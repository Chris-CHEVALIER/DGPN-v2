<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230703110847 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event_unit (id INT AUTO_INCREMENT NOT NULL, event_id INT DEFAULT NULL, unit_id INT DEFAULT NULL, reassign_from_id INT DEFAULT NULL, reassign TINYINT(1) NOT NULL, INDEX IDX_C37040F871F7E88B (event_id), INDEX IDX_C37040F8F8BD700D (unit_id), UNIQUE INDEX UNIQ_C37040F8655B01CB (reassign_from_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event_unit ADD CONSTRAINT FK_C37040F871F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE event_unit ADD CONSTRAINT FK_C37040F8F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id)');
        $this->addSql('ALTER TABLE event_unit ADD CONSTRAINT FK_C37040F8655B01CB FOREIGN KEY (reassign_from_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE unit CHANGE unit_tyoe unit_type VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_unit DROP FOREIGN KEY FK_C37040F871F7E88B');
        $this->addSql('ALTER TABLE event_unit DROP FOREIGN KEY FK_C37040F8F8BD700D');
        $this->addSql('ALTER TABLE event_unit DROP FOREIGN KEY FK_C37040F8655B01CB');
        $this->addSql('DROP TABLE event_unit');
        $this->addSql('ALTER TABLE unit CHANGE unit_type unit_tyoe VARCHAR(255) NOT NULL');
    }
}
