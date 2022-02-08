<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220208153246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE campo (id INT AUTO_INCREMENT NOT NULL, tipo VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipo (id INT AUTO_INCREMENT NOT NULL, liga_id INT DEFAULT NULL, nombre VARCHAR(100) NOT NULL, INDEX IDX_C49C530BCF098064 (liga_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipo_usuario (equipo_id INT NOT NULL, usuario_id INT NOT NULL, INDEX IDX_6F4B267F23BFBED (equipo_id), INDEX IDX_6F4B267FDB38439E (usuario_id), PRIMARY KEY(equipo_id, usuario_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liga (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(100) NOT NULL, tipo VARCHAR(20) NOT NULL, fecha_inicio DATETIME NOT NULL, fecha_fin DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partido (id INT AUTO_INCREMENT NOT NULL, arbitro_id INT NOT NULL, campo_id INT NOT NULL, liga_id INT NOT NULL, local_id INT NOT NULL, visitante_id INT NOT NULL, fecha_hora DATETIME NOT NULL, resultado LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', INDEX IDX_4E79750B66FE4594 (arbitro_id), INDEX IDX_4E79750BA17A385C (campo_id), INDEX IDX_4E79750BCF098064 (liga_id), INDEX IDX_4E79750B5D5A2101 (local_id), INDEX IDX_4E79750BD80AA8AF (visitante_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reserva (id INT AUTO_INCREMENT NOT NULL, vigila_id INT NOT NULL, equipo_id INT NOT NULL, campo_id INT NOT NULL, fecha_hora DATETIME NOT NULL, INDEX IDX_188D2E3B8DA62F90 (vigila_id), INDEX IDX_188D2E3B23BFBED (equipo_id), INDEX IDX_188D2E3BA17A385C (campo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, equipo_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nombre VARCHAR(50) NOT NULL, apellidos VARCHAR(100) NOT NULL, curso VARCHAR(30) DEFAULT NULL, UNIQUE INDEX UNIQ_2265B05DE7927C74 (email), INDEX IDX_2265B05D23BFBED (equipo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipo ADD CONSTRAINT FK_C49C530BCF098064 FOREIGN KEY (liga_id) REFERENCES liga (id)');
        $this->addSql('ALTER TABLE equipo_usuario ADD CONSTRAINT FK_6F4B267F23BFBED FOREIGN KEY (equipo_id) REFERENCES equipo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipo_usuario ADD CONSTRAINT FK_6F4B267FDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partido ADD CONSTRAINT FK_4E79750B66FE4594 FOREIGN KEY (arbitro_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE partido ADD CONSTRAINT FK_4E79750BA17A385C FOREIGN KEY (campo_id) REFERENCES campo (id)');
        $this->addSql('ALTER TABLE partido ADD CONSTRAINT FK_4E79750BCF098064 FOREIGN KEY (liga_id) REFERENCES liga (id)');
        $this->addSql('ALTER TABLE partido ADD CONSTRAINT FK_4E79750B5D5A2101 FOREIGN KEY (local_id) REFERENCES equipo (id)');
        $this->addSql('ALTER TABLE partido ADD CONSTRAINT FK_4E79750BD80AA8AF FOREIGN KEY (visitante_id) REFERENCES equipo (id)');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3B8DA62F90 FOREIGN KEY (vigila_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3B23BFBED FOREIGN KEY (equipo_id) REFERENCES equipo (id)');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3BA17A385C FOREIGN KEY (campo_id) REFERENCES campo (id)');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05D23BFBED FOREIGN KEY (equipo_id) REFERENCES equipo (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partido DROP FOREIGN KEY FK_4E79750BA17A385C');
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3BA17A385C');
        $this->addSql('ALTER TABLE equipo_usuario DROP FOREIGN KEY FK_6F4B267F23BFBED');
        $this->addSql('ALTER TABLE partido DROP FOREIGN KEY FK_4E79750B5D5A2101');
        $this->addSql('ALTER TABLE partido DROP FOREIGN KEY FK_4E79750BD80AA8AF');
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3B23BFBED');
        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05D23BFBED');
        $this->addSql('ALTER TABLE equipo DROP FOREIGN KEY FK_C49C530BCF098064');
        $this->addSql('ALTER TABLE partido DROP FOREIGN KEY FK_4E79750BCF098064');
        $this->addSql('ALTER TABLE equipo_usuario DROP FOREIGN KEY FK_6F4B267FDB38439E');
        $this->addSql('ALTER TABLE partido DROP FOREIGN KEY FK_4E79750B66FE4594');
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3B8DA62F90');
        $this->addSql('DROP TABLE campo');
        $this->addSql('DROP TABLE equipo');
        $this->addSql('DROP TABLE equipo_usuario');
        $this->addSql('DROP TABLE liga');
        $this->addSql('DROP TABLE partido');
        $this->addSql('DROP TABLE reserva');
        $this->addSql('DROP TABLE usuario');
    }
}
