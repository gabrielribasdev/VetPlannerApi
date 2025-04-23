<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250423003443 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE agendamentos_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cadastro_pet_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cadastro_tutor_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE servicos_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE agendamentos (id INT NOT NULL, pet_id INT DEFAULT NULL, servico_id INT DEFAULT NULL, data DATE DEFAULT NULL, horario TIME(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2D12EA4A966F7FB6 ON agendamentos (pet_id)');
        $this->addSql('CREATE INDEX IDX_2D12EA4A82E14982 ON agendamentos (servico_id)');
        $this->addSql('CREATE TABLE cadastro_pet (id INT NOT NULL, tutor_id INT NOT NULL, nome VARCHAR(100) DEFAULT NULL, idade INT DEFAULT NULL, sexo VARCHAR(30) DEFAULT NULL, peso DOUBLE PRECISION DEFAULT NULL, raca VARCHAR(100) DEFAULT NULL, data_cadastro DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C95A73FC208F64F1 ON cadastro_pet (tutor_id)');
        $this->addSql('CREATE TABLE cadastro_tutor (id INT NOT NULL, nome VARCHAR(200) DEFAULT NULL, email VARCHAR(100) DEFAULT NULL, telefone VARCHAR(50) DEFAULT NULL, cpf VARCHAR(20) DEFAULT NULL, endereco TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE servicos (id INT NOT NULL, nome VARCHAR(200) NOT NULL, duracao TIME(0) WITHOUT TIME ZONE DEFAULT NULL, preco NUMERIC(10, 0) DEFAULT NULL, observacao TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE agendamentos ADD CONSTRAINT FK_2D12EA4A966F7FB6 FOREIGN KEY (pet_id) REFERENCES cadastro_pet (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE agendamentos ADD CONSTRAINT FK_2D12EA4A82E14982 FOREIGN KEY (servico_id) REFERENCES servicos (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cadastro_pet ADD CONSTRAINT FK_C95A73FC208F64F1 FOREIGN KEY (tutor_id) REFERENCES cadastro_tutor (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE agendamentos_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE cadastro_pet_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE cadastro_tutor_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE servicos_id_seq CASCADE');
        $this->addSql('ALTER TABLE agendamentos DROP CONSTRAINT FK_2D12EA4A966F7FB6');
        $this->addSql('ALTER TABLE agendamentos DROP CONSTRAINT FK_2D12EA4A82E14982');
        $this->addSql('ALTER TABLE cadastro_pet DROP CONSTRAINT FK_C95A73FC208F64F1');
        $this->addSql('DROP TABLE agendamentos');
        $this->addSql('DROP TABLE cadastro_pet');
        $this->addSql('DROP TABLE cadastro_tutor');
        $this->addSql('DROP TABLE servicos');
    }
}
