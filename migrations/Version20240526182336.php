<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240526182336 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE presupuesto ADD descripcion_proyecto VARCHAR(255) NOT NULL, ADD correo_contacto VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE locale locale VARCHAR(2) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE presupuesto DROP descripcion_proyecto, DROP correo_contacto');
        $this->addSql('ALTER TABLE user CHANGE locale locale VARCHAR(255) DEFAULT NULL');
    }
}
