<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200317085852 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ordinateur ADD marque_id INT NOT NULL, CHANGE numero numero SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE ordinateur ADD CONSTRAINT FK_8712E8DB4827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('CREATE INDEX IDX_8712E8DB4827B9B2 ON ordinateur (marque_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ordinateur DROP FOREIGN KEY FK_8712E8DB4827B9B2');
        $this->addSql('DROP INDEX IDX_8712E8DB4827B9B2 ON ordinateur');
        $this->addSql('ALTER TABLE ordinateur DROP marque_id, CHANGE numero numero SMALLINT DEFAULT NULL');
    }
}
