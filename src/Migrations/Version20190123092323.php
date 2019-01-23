<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190123092323 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE performers (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, biography LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE performances (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, date DATE NOT NULL, time TIME NOT NULL, picture VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE performances_performers (performances_id INT NOT NULL, performers_id INT NOT NULL, INDEX IDX_33A2A56EA07A6884 (performances_id), INDEX IDX_33A2A56EC3A975B0 (performers_id), PRIMARY KEY(performances_id, performers_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE performances_performers ADD CONSTRAINT FK_33A2A56EA07A6884 FOREIGN KEY (performances_id) REFERENCES performances (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE performances_performers ADD CONSTRAINT FK_33A2A56EC3A975B0 FOREIGN KEY (performers_id) REFERENCES performers (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE performances_performers DROP FOREIGN KEY FK_33A2A56EC3A975B0');
        $this->addSql('ALTER TABLE performances_performers DROP FOREIGN KEY FK_33A2A56EA07A6884');
        $this->addSql('DROP TABLE performers');
        $this->addSql('DROP TABLE performances');
        $this->addSql('DROP TABLE performances_performers');
    }
}
