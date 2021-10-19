<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210910110356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE launcher_config (id INT AUTO_INCREMENT NOT NULL, fallback_video LONGTEXT NOT NULL, fallback_audio LONGTEXT DEFAULT NULL, login_api LONGTEXT NOT NULL, skin_api LONGTEXT NOT NULL, server_ip VARCHAR(255) NOT NULL, server_port INT NOT NULL, distro_list LONGTEXT NOT NULL, site_name VARCHAR(255) NOT NULL, news_api LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE launcher_config');
    }
}
