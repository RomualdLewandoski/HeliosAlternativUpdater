<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210910011307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ressource_pack (id INT AUTO_INCREMENT NOT NULL, id_name VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, size INT NOT NULL, md5 VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, url LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ressource_pack_server (ressource_pack_id INT NOT NULL, server_id INT NOT NULL, INDEX IDX_74A24695AC233CF5 (ressource_pack_id), INDEX IDX_74A246951844E6B7 (server_id), PRIMARY KEY(ressource_pack_id, server_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ressource_pack_server ADD CONSTRAINT FK_74A24695AC233CF5 FOREIGN KEY (ressource_pack_id) REFERENCES ressource_pack (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ressource_pack_server ADD CONSTRAINT FK_74A246951844E6B7 FOREIGN KEY (server_id) REFERENCES server (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ressource_pack_server DROP FOREIGN KEY FK_74A24695AC233CF5');
        $this->addSql('DROP TABLE ressource_pack');
        $this->addSql('DROP TABLE ressource_pack_server');
    }
}
