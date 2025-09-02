<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250901114345 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE news_category ADD COLUMN language INTEGER DEFAULT NULL');
        $this->addSql('ALTER TABLE product_property ADD COLUMN language INTEGER DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__news_category AS SELECT id, title FROM news_category');
        $this->addSql('DROP TABLE news_category');
        $this->addSql('CREATE TABLE news_category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO news_category (id, title) SELECT id, title FROM __temp__news_category');
        $this->addSql('DROP TABLE __temp__news_category');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product_property AS SELECT id, title FROM product_property');
        $this->addSql('DROP TABLE product_property');
        $this->addSql('CREATE TABLE product_property (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO product_property (id, title) SELECT id, title FROM __temp__product_property');
        $this->addSql('DROP TABLE __temp__product_property');
    }
}
