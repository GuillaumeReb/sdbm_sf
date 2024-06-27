<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240627125030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE marque (id INT AUTO_INCREMENT NOT NULL, pays_id INT DEFAULT NULL, fabricants_id INT DEFAULT NULL, nom_marque VARCHAR(40) NOT NULL, INDEX IDX_5A6F91CEA6E44244 (pays_id), INDEX IDX_5A6F91CEB5D2F5B9 (fabricants_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE marque ADD CONSTRAINT FK_5A6F91CEA6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE marque ADD CONSTRAINT FK_5A6F91CEB5D2F5B9 FOREIGN KEY (fabricants_id) REFERENCES fabricant (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE marque DROP FOREIGN KEY FK_5A6F91CEA6E44244');
        $this->addSql('ALTER TABLE marque DROP FOREIGN KEY FK_5A6F91CEB5D2F5B9');
        $this->addSql('DROP TABLE marque');
    }
}
