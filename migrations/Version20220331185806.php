<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220331185806 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
//        $this->addSql('CREATE TABLE presupuesto (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, tipo VARCHAR(10) NOT NULL, estado VARCHAR(10) NOT NULL, precio_final DOUBLE PRECISION DEFAULT NULL, INDEX IDX_1B6368D3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//        $this->addSql('CREATE TABLE proyecto (id INT AUTO_INCREMENT NOT NULL, presupuesto_id INT NOT NULL, fecha_entrega DATETIME NOT NULL, estado VARCHAR(10) NOT NULL, UNIQUE INDEX UNIQ_6FD202B990119F0F (presupuesto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//        $this->addSql('CREATE TABLE tarea (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, proyecto_id INT NOT NULL, estado VARCHAR(10) NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, INDEX IDX_3CA05366A76ED395 (user_id), INDEX IDX_3CA05366F625D1BA (proyecto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//        $this->addSql('ALTER TABLE presupuesto ADD CONSTRAINT FK_1B6368D3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
//        $this->addSql('ALTER TABLE proyecto ADD CONSTRAINT FK_6FD202B990119F0F FOREIGN KEY (presupuesto_id) REFERENCES presupuesto (id)');
//        $this->addSql('ALTER TABLE tarea ADD CONSTRAINT FK_3CA05366A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
//        $this->addSql('ALTER TABLE tarea ADD CONSTRAINT FK_3CA05366F625D1BA FOREIGN KEY (proyecto_id) REFERENCES proyecto (id)');
//        $this->addSql('ALTER TABLE user CHANGE locale locale ENUM(\'ES\', \'EN\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
//        $this->addSql('ALTER TABLE proyecto DROP FOREIGN KEY FK_6FD202B990119F0F');
//        $this->addSql('ALTER TABLE tarea DROP FOREIGN KEY FK_3CA05366F625D1BA');
//        $this->addSql('DROP TABLE presupuesto');
//        $this->addSql('DROP TABLE proyecto');
//        $this->addSql('DROP TABLE tarea');
//        $this->addSql('ALTER TABLE user CHANGE locale locale VARCHAR(2) DEFAULT NULL');
    }
}
