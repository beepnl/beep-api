<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191209221511 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE device (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', clazz VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE first_party_device (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', dev_eui VARCHAR(255) DEFAULT NULL, app_eui VARCHAR(255) DEFAULT NULL, app_key VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sensor (id INT AUTO_INCREMENT NOT NULL, device_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(128) NOT NULL, INDEX IDX_BC8617B094A4C7D4 (device_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE first_party_device ADD CONSTRAINT FK_3AAD9B46BF396750 FOREIGN KEY (id) REFERENCES device (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sensor ADD CONSTRAINT FK_BC8617B094A4C7D4 FOREIGN KEY (device_id) REFERENCES device (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE first_party_device DROP FOREIGN KEY FK_3AAD9B46BF396750');
        $this->addSql('ALTER TABLE sensor DROP FOREIGN KEY FK_BC8617B094A4C7D4');
        $this->addSql('DROP TABLE device');
        $this->addSql('DROP TABLE first_party_device');
        $this->addSql('DROP TABLE sensor');
    }
}
