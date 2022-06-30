<?php

declare(strict_types=1);

namespace Alura\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220627031803 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__Curso AS SELECT id, name FROM Curso');
        $this->addSql('DROP TABLE Curso');
        $this->addSql('CREATE TABLE Curso (id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO Curso (id, name) SELECT id, name FROM __temp__Curso');
        $this->addSql('DROP TABLE __temp__Curso');
        $this->addSql('DROP INDEX IDX_9E070C0D87CB4A1F');
        $this->addSql('DROP INDEX IDX_9E070C0DCB944F1A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__curso_student AS SELECT curso_id, student_id FROM curso_student');
        $this->addSql('DROP TABLE curso_student');
        $this->addSql('CREATE TABLE curso_student (curso_id INTEGER NOT NULL, student_id INTEGER NOT NULL, PRIMARY KEY(curso_id, student_id), CONSTRAINT FK_9E070C0D87CB4A1F FOREIGN KEY (curso_id) REFERENCES Curso (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9E070C0DCB944F1A FOREIGN KEY (student_id) REFERENCES Student (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO curso_student (curso_id, student_id) SELECT curso_id, student_id FROM __temp__curso_student');
        $this->addSql('DROP TABLE __temp__curso_student');
        $this->addSql('CREATE INDEX IDX_9E070C0D87CB4A1F ON curso_student (curso_id)');
        $this->addSql('CREATE INDEX IDX_9E070C0DCB944F1A ON curso_student (student_id)');
        $this->addSql('DROP INDEX IDX_858EB8D9CB944F1A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__Phone AS SELECT id, student_id, phoneNumber FROM Phone');
        $this->addSql('DROP TABLE Phone');
        $this->addSql('CREATE TABLE Phone (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, student_id INTEGER DEFAULT NULL, phoneNumber VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_858EB8D9CB944F1A FOREIGN KEY (student_id) REFERENCES Student (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO Phone (id, student_id, phoneNumber) SELECT id, student_id, phoneNumber FROM __temp__Phone');
        $this->addSql('DROP TABLE __temp__Phone');
        $this->addSql('CREATE INDEX IDX_858EB8D9CB944F1A ON Phone (student_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__Curso AS SELECT id, name FROM Curso');
        $this->addSql('DROP TABLE Curso');
        $this->addSql('CREATE TABLE Curso (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO Curso (id, name) SELECT id, name FROM __temp__Curso');
        $this->addSql('DROP TABLE __temp__Curso');
        $this->addSql('DROP INDEX IDX_858EB8D9CB944F1A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__Phone AS SELECT id, student_id, phoneNumber FROM Phone');
        $this->addSql('DROP TABLE Phone');
        $this->addSql('CREATE TABLE Phone (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, student_id INTEGER DEFAULT NULL, phoneNumber VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO Phone (id, student_id, phoneNumber) SELECT id, student_id, phoneNumber FROM __temp__Phone');
        $this->addSql('DROP TABLE __temp__Phone');
        $this->addSql('CREATE INDEX IDX_858EB8D9CB944F1A ON Phone (student_id)');
        $this->addSql('DROP INDEX IDX_9E070C0D87CB4A1F');
        $this->addSql('DROP INDEX IDX_9E070C0DCB944F1A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__curso_student AS SELECT curso_id, student_id FROM curso_student');
        $this->addSql('DROP TABLE curso_student');
        $this->addSql('CREATE TABLE curso_student (curso_id INTEGER NOT NULL, student_id INTEGER NOT NULL, PRIMARY KEY(curso_id, student_id))');
        $this->addSql('INSERT INTO curso_student (curso_id, student_id) SELECT curso_id, student_id FROM __temp__curso_student');
        $this->addSql('DROP TABLE __temp__curso_student');
        $this->addSql('CREATE INDEX IDX_9E070C0D87CB4A1F ON curso_student (curso_id)');
        $this->addSql('CREATE INDEX IDX_9E070C0DCB944F1A ON curso_student (student_id)');
    }
}
