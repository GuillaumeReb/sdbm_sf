<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240703120632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE marque CHANGE fabricants_id fabricants_id INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_349F3CAEC64FF6C0 ON pays (nom_pays)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE marque CHANGE fabricants_id fabricants_id INT DEFAULT NULL');
        $this->addSql('DROP INDEX UNIQ_349F3CAEC64FF6C0 ON pays');
    }
}
