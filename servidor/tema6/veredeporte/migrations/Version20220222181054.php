<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220222181054 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipo ADD solicitar_participar_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE equipo ADD CONSTRAINT FK_C49C530B80285EAB FOREIGN KEY (solicitar_participar_id) REFERENCES liga (id)');
        $this->addSql('CREATE INDEX IDX_C49C530B80285EAB ON equipo (solicitar_participar_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipo DROP FOREIGN KEY FK_C49C530B80285EAB');
        $this->addSql('DROP INDEX IDX_C49C530B80285EAB ON equipo');
        $this->addSql('ALTER TABLE equipo DROP solicitar_participar_id');
    }
}
