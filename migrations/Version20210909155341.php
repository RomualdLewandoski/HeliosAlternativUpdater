<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210909155341 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mod_server (mod_id INT NOT NULL, server_id INT NOT NULL, INDEX IDX_2EDAEA89338E21CD (mod_id), INDEX IDX_2EDAEA891844E6B7 (server_id), PRIMARY KEY(mod_id, server_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mod_server ADD CONSTRAINT FK_2EDAEA89338E21CD FOREIGN KEY (mod_id) REFERENCES `mod` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mod_server ADD CONSTRAINT FK_2EDAEA891844E6B7 FOREIGN KEY (server_id) REFERENCES server (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `mod` ADD id_name VARCHAR(255) NOT NULL, ADD name VARCHAR(255) NOT NULL, ADD type VARCHAR(255) NOT NULL, ADD size INT NOT NULL, ADD md5 VARCHAR(255) NOT NULL, ADD url LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE mod_server');
        $this->addSql('ALTER TABLE `mod` DROP id_name, DROP name, DROP type, DROP size, DROP md5, DROP url');
    }
}
