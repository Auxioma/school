<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250426131922 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE product ADD image_name VARCHAR(255) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product ADD image_size INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product DROP picture
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE slider ADD image_name VARCHAR(255) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE slider ADD image_size INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE slider DROP picture
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE teachers ADD image_name VARCHAR(255) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE teachers ADD image_size INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE teachers DROP pictures
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE testimonial ADD image_name VARCHAR(255) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE testimonial ADD image_size INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE testimonial DROP image
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE testimonial ADD image VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE testimonial DROP image_name
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE testimonial DROP image_size
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE teachers ADD pictures VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE teachers DROP image_name
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE teachers DROP image_size
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE slider ADD picture VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE slider DROP image_name
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE slider DROP image_size
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product ADD picture VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product DROP image_name
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product DROP image_size
        SQL);
    }
}
