<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250315123410 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reset_password_request DROP CONSTRAINT fk_7ce748aa76ed395');
        $this->addSql('ALTER TABLE blog DROP CONSTRAINT fk_c0155143a76ed395');
        $this->addSql('ALTER TABLE testimonial DROP CONSTRAINT fk_e6bdcdf73256915b');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('CREATE TABLE users (id SERIAL NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON users (email)');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('ALTER TABLE blog DROP CONSTRAINT FK_C0155143A76ED395');
        $this->addSql('ALTER TABLE blog ADD CONSTRAINT FK_C0155143A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reset_password_request DROP CONSTRAINT FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE testimonial DROP CONSTRAINT FK_E6BDCDF73256915B');
        $this->addSql('ALTER TABLE testimonial ADD CONSTRAINT FK_E6BDCDF73256915B FOREIGN KEY (relation_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE blog DROP CONSTRAINT FK_C0155143A76ED395');
        $this->addSql('ALTER TABLE reset_password_request DROP CONSTRAINT FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE testimonial DROP CONSTRAINT FK_E6BDCDF73256915B');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_identifier_email ON "user" (email)');
        $this->addSql('DROP TABLE users');
        $this->addSql('ALTER TABLE reset_password_request DROP CONSTRAINT fk_7ce748aa76ed395');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT fk_7ce748aa76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE blog DROP CONSTRAINT fk_c0155143a76ed395');
        $this->addSql('ALTER TABLE blog ADD CONSTRAINT fk_c0155143a76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE testimonial DROP CONSTRAINT fk_e6bdcdf73256915b');
        $this->addSql('ALTER TABLE testimonial ADD CONSTRAINT fk_e6bdcdf73256915b FOREIGN KEY (relation_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
