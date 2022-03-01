<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220301150657 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE examen ADD pertenece_id INT NOT NULL');
        $this->addSql('ALTER TABLE examen ADD CONSTRAINT FK_514C8FEC713EAB9D FOREIGN KEY (pertenece_id) REFERENCES asignatura (id)');
        $this->addSql('CREATE INDEX IDX_514C8FEC713EAB9D ON examen (pertenece_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE examen DROP FOREIGN KEY FK_514C8FEC713EAB9D');
        $this->addSql('DROP INDEX IDX_514C8FEC713EAB9D ON examen');
        $this->addSql('ALTER TABLE examen DROP pertenece_id');
    }
}
