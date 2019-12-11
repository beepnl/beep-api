<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191211221536 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE device (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', account_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', device_id VARCHAR(64) NOT NULL, clazz VARCHAR(255) NOT NULL, INDEX IDX_92FB68E9B6B5FBA (account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE first_party_device (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE apiary (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', account_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', roofed TINYINT(1) NOT NULL, INDEX IDX_B05356E19B6B5FBA (account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE account (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sensor (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', device_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(128) NOT NULL, INDEX IDX_BC8617B094A4C7D4 (device_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hive (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE account_membership (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', user_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', account_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', role VARCHAR(128) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7A642021A76ED395 (user_id), INDEX IDX_7A6420219B6B5FBA (account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE device ADD CONSTRAINT FK_92FB68E9B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id)');
        $this->addSql('ALTER TABLE first_party_device ADD CONSTRAINT FK_3AAD9B46BF396750 FOREIGN KEY (id) REFERENCES device (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE apiary ADD CONSTRAINT FK_B05356E19B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id)');
        $this->addSql('ALTER TABLE sensor ADD CONSTRAINT FK_BC8617B094A4C7D4 FOREIGN KEY (device_id) REFERENCES device (id)');
        $this->addSql('ALTER TABLE account_membership ADD CONSTRAINT FK_7A642021A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE account_membership ADD CONSTRAINT FK_7A6420219B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE first_party_device DROP FOREIGN KEY FK_3AAD9B46BF396750');
        $this->addSql('ALTER TABLE sensor DROP FOREIGN KEY FK_BC8617B094A4C7D4');
        $this->addSql('ALTER TABLE account_membership DROP FOREIGN KEY FK_7A642021A76ED395');
        $this->addSql('ALTER TABLE device DROP FOREIGN KEY FK_92FB68E9B6B5FBA');
        $this->addSql('ALTER TABLE apiary DROP FOREIGN KEY FK_B05356E19B6B5FBA');
        $this->addSql('ALTER TABLE account_membership DROP FOREIGN KEY FK_7A6420219B6B5FBA');
        $this->addSql('DROP TABLE device');
        $this->addSql('DROP TABLE first_party_device');
        $this->addSql('DROP TABLE apiary');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE sensor');
        $this->addSql('DROP TABLE hive');
        $this->addSql('DROP TABLE account_membership');
    }
}
