<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220119140541 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE estudios (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(100) NOT NULL, creditos INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alumno ADD estudios_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE alumno ADD CONSTRAINT FK_1435D52DB56F7D88 FOREIGN KEY (estudios_id) REFERENCES estudios (id)');
        $this->addSql('CREATE INDEX IDX_1435D52DB56F7D88 ON alumno (estudios_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alumno DROP FOREIGN KEY FK_1435D52DB56F7D88');
        $this->addSql('DROP TABLE estudios');
        $this->addSql('DROP INDEX IDX_1435D52DB56F7D88 ON alumno');
        $this->addSql('ALTER TABLE alumno DROP estudios_id');
    }
}
