<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250207132814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE translation ADD `key` VARCHAR(255) NOT NULL, ADD locale VARCHAR(10) NOT NULL, ADD message LONGTEXT NOT NULL, DROP cle, DROP local, DROP translation');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE translation ADD local VARCHAR(255) NOT NULL, ADD translation VARCHAR(255) NOT NULL, DROP locale, DROP message, CHANGE `key` cle VARCHAR(255) NOT NULL');
    }
}
