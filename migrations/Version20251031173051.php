<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251031173051 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user (email)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__banner AS SELECT id, title, subtitle, active, position, url, image, img_update_at FROM banner');
        $this->addSql('DROP TABLE banner');
        $this->addSql('CREATE TABLE banner (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, subtitle VARCHAR(255) DEFAULT NULL, active INTEGER DEFAULT NULL, position INTEGER DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, img_update_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO banner (id, title, subtitle, active, position, url, image, img_update_at) SELECT id, title, subtitle, active, position, url, image, img_update_at FROM __temp__banner');
        $this->addSql('DROP TABLE __temp__banner');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TEMPORARY TABLE __temp__banner AS SELECT id, title, subtitle, active, position, url, image, img_update_at FROM banner');
        $this->addSql('DROP TABLE banner');
        $this->addSql('CREATE TABLE banner (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, subtitle VARCHAR(255) DEFAULT NULL, active INTEGER DEFAULT NULL, position INTEGER DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, img_update_at DATETIME DEFAULT NULL)');
        $this->addSql('INSERT INTO banner (id, title, subtitle, active, position, url, image, img_update_at) SELECT id, title, subtitle, active, position, url, image, img_update_at FROM __temp__banner');
        $this->addSql('DROP TABLE __temp__banner');
    }
}
