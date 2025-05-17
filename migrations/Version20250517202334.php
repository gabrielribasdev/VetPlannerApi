<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250517202334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE vacinas_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE vacinas (id INT NOT NULL, nome VARCHAR(255) NOT NULL, marca VARCHAR(255) NOT NULL, preco NUMERIC(10, 2) NOT NULL, periodo INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE servicos ALTER cor DROP DEFAULT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE vacinas_id_seq CASCADE');
        $this->addSql('DROP TABLE vacinas');
        $this->addSql('ALTER TABLE servicos ALTER cor SET DEFAULT \'\'');
    }
}
