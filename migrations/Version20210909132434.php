<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210909132434 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE files_server (files_id INT NOT NULL, server_id INT NOT NULL, INDEX IDX_56E1FC57A3E65B2F (files_id), INDEX IDX_56E1FC571844E6B7 (server_id), PRIMARY KEY(files_id, server_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE files_server ADD CONSTRAINT FK_56E1FC57A3E65B2F FOREIGN KEY (files_id) REFERENCES files (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE files_server ADD CONSTRAINT FK_56E1FC571844E6B7 FOREIGN KEY (server_id) REFERENCES server (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE files ADD id_name VARCHAR(255) NOT NULL, ADD name VARCHAR(255) NOT NULL, ADD type VARCHAR(255) NOT NULL, ADD size INT NOT NULL, ADD is_md5 TINYINT(1) NOT NULL, ADD md5 VARCHAR(255) DEFAULT NULL, ADD url LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE files_server');
        $this->addSql('ALTER TABLE files DROP id_name, DROP name, DROP type, DROP size, DROP is_md5, DROP md5, DROP url');
    }
}
