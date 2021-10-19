<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210907221156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE files (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forge_hosted (id INT AUTO_INCREMENT NOT NULL, id_name VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, size INT NOT NULL, md5 VARCHAR(255) NOT NULL, url LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE library (id INT AUTO_INCREMENT NOT NULL, id_name VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, size INT NOT NULL, md5 VARCHAR(255) NOT NULL, url LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE library_server (library_id INT NOT NULL, server_id INT NOT NULL, INDEX IDX_F18F4D7DFE2541D7 (library_id), INDEX IDX_F18F4D7D1844E6B7 (server_id), PRIMARY KEY(library_id, server_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `mod` (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE library_server ADD CONSTRAINT FK_F18F4D7DFE2541D7 FOREIGN KEY (library_id) REFERENCES library (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE library_server ADD CONSTRAINT FK_F18F4D7D1844E6B7 FOREIGN KEY (server_id) REFERENCES server (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE server ADD forge_hosted_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE server ADD CONSTRAINT FK_5A6DD5F65D75925F FOREIGN KEY (forge_hosted_id) REFERENCES forge_hosted (id)');
        $this->addSql('CREATE INDEX IDX_5A6DD5F65D75925F ON server (forge_hosted_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE server DROP FOREIGN KEY FK_5A6DD5F65D75925F');
        $this->addSql('ALTER TABLE library_server DROP FOREIGN KEY FK_F18F4D7DFE2541D7');
        $this->addSql('DROP TABLE files');
        $this->addSql('DROP TABLE forge_hosted');
        $this->addSql('DROP TABLE library');
        $this->addSql('DROP TABLE library_server');
        $this->addSql('DROP TABLE `mod`');
        $this->addSql('DROP INDEX IDX_5A6DD5F65D75925F ON server');
        $this->addSql('ALTER TABLE server DROP forge_hosted_id');
    }
}
