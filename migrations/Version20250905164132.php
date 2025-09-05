<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250905164132 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE page_seo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, home_page_title VARCHAR(255) NOT NULL, home_page_description VARCHAR(255) NOT NULL, about_us_page_title VARCHAR(255) NOT NULL, about_us_page_description VARCHAR(255) NOT NULL, product_listing_page_title VARCHAR(255) NOT NULL, product_listing_page_description VARCHAR(255) NOT NULL, news_listing_page_title VARCHAR(255) NOT NULL, news_listing_page_description VARCHAR(255) NOT NULL, service_listing_page_title VARCHAR(255) NOT NULL, service_listing_page_description VARCHAR(255) NOT NULL, financing_list_page_title VARCHAR(255) NOT NULL, finance_list_page_description VARCHAR(255) NOT NULL, video_listing_page_title VARCHAR(255) NOT NULL, video_listing_page_description VARCHAR(255) NOT NULL, language INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__news_category AS SELECT id, title, language FROM news_category');
        $this->addSql('DROP TABLE news_category');
        $this->addSql('CREATE TABLE news_category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, language INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO news_category (id, title, language) SELECT id, title, language FROM __temp__news_category');
        $this->addSql('DROP TABLE __temp__news_category');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE page_seo');
        $this->addSql('CREATE TEMPORARY TABLE __temp__news_category AS SELECT id, title, language FROM news_category');
        $this->addSql('DROP TABLE news_category');
        $this->addSql('CREATE TABLE news_category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, language INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO news_category (id, title, language) SELECT id, title, language FROM __temp__news_category');
        $this->addSql('DROP TABLE __temp__news_category');
    }
}
