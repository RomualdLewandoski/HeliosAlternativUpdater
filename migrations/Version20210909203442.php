<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210909203442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE shader_server (shader_id INT NOT NULL, server_id INT NOT NULL, INDEX IDX_A9F11EC19B69D6A5 (shader_id), INDEX IDX_A9F11EC11844E6B7 (server_id), PRIMARY KEY(shader_id, server_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shader_server ADD CONSTRAINT FK_A9F11EC19B69D6A5 FOREIGN KEY (shader_id) REFERENCES shader (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shader_server ADD CONSTRAINT FK_A9F11EC11844E6B7 FOREIGN KEY (server_id) REFERENCES server (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE shader_server');
    }
}
